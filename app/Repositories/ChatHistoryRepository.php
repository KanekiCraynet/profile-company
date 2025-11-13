<?php

namespace App\Repositories;

use App\Models\ChatHistory;

class ChatHistoryRepository extends BaseRepository
{
    /**
     * Create a new repository instance.
     */
    public function __construct(ChatHistory $model)
    {
        parent::__construct($model);
    }

    /**
     * Get chat history by session ID.
     *
     * @param string $sessionId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBySession(string $sessionId)
    {
        return $this->model
            ->where('session_id', $sessionId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Get recent chat history.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecent(int $limit = 50)
    {
        return $this->model
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get analytics data.
     *
     * @param int $days
     * @return array
     */
    public function getAnalytics(int $days = 30)
    {
        $startDate = now()->subDays($days);
        
        return [
            'total_messages' => $this->model->where('created_at', '>=', $startDate)->count(),
            'unique_sessions' => $this->model->where('created_at', '>=', $startDate)->distinct('session_id')->count('session_id'),
            'messages_by_day' => $this->model
                ->where('created_at', '>=', $startDate)
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get(),
        ];
    }
}

