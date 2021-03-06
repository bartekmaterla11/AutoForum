<?php

declare(strict_types=1);

namespace App\Service\Posts;

use App\Entity\Posts\Post;
use App\Query\Posts\NumberOfAnswersOnePostQuery;

class NumberOfAnswersOnePostService implements NumberOfAnswerOnePostInterface
{
    /**
     * @var NumberOfAnswersOnePostQuery
     */
    private $answersOnePostQuery;

    public function __construct(NumberOfAnswersOnePostQuery $answersOnePostQuery)
    {
        $this->answersOnePostQuery = $answersOnePostQuery;
    }

    public function getNumberOfAnswers($post): array
    {
        $numbers = [];
        $numbers['answer'] = $this->answersOnePostQuery->downloadNumberOfAnswersOnePost($post);

        return $numbers;
    }

}