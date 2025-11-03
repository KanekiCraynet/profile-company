<?php

namespace App\Repositories;

use App\Models\ChatbotRule;

class ChatbotRuleRepository extends BaseRepository
{
    /**
     * Create a new repository instance.
     */
    public function __construct(ChatbotRule $model)
    {
        parent::__construct($model);
    }

    /**
     * Get active rules ordered by priority.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveRules()
    {
        return $this->model
            ->where('status', 'active')
            ->orderBy('priority', 'asc')
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * Find matching rule by keyword.
     *
     * @param string $message
     * @return \App\Models\ChatbotRule|null
     */
    public function findMatchingRule(string $message)
    {
        $message = strtolower(trim($message));
        
        // Get all active rules
        $rules = $this->model
            ->where('status', 'active')
            ->orderBy('priority', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        // Check if any keyword appears in the message
        foreach ($rules as $rule) {
            if (str_contains($message, strtolower($rule->keyword))) {
                return $rule;
            }
        }

        return null;
    }
}

