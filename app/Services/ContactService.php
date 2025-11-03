<?php

namespace App\Services;

use App\Repositories\ContactRepository;
use Illuminate\Support\Facades\RateLimiter;

class ContactService
{
    public function __construct(
        protected ContactRepository $repository
    ) {}

    /**
     * Create a new contact submission.
     *
     * @param array $data
     * @param string|null $ipAddress
     * @param string|null $userAgent
     * @return \App\Models\Contact
     */
    public function create(array $data, ?string $ipAddress = null, ?string $userAgent = null)
    {
        // Check rate limit (max 5 submissions per minute per IP)
        $key = 'contact_form:' . ($ipAddress ?? 'unknown');
        
        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw new \Exception('Too many submission attempts. Please try again later.');
        }

        RateLimiter::hit($key, 60); // 60 seconds

        // Add IP address and user agent
        $data['ip_address'] = $ipAddress;
        $data['user_agent'] = $userAgent;

        return $this->repository->create($data);
    }

    /**
     * Mark contact as read.
     *
     * @param int $id
     * @return bool
     */
    public function markAsRead(int $id): bool
    {
        return $this->repository->markAsRead($id);
    }

    /**
     * Mark contact as replied.
     *
     * @param int $id
     * @return bool
     */
    public function markAsReplied(int $id): bool
    {
        return $this->repository->markAsReplied($id);
    }

    /**
     * Get unread contacts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUnreadContacts()
    {
        return $this->repository->getUnreadContacts();
    }
}

