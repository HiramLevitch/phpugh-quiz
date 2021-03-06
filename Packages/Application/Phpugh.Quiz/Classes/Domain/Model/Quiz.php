<?php
namespace Phpugh\Quiz\Domain\Model;

/*
 * This file is part of the Phpugh.Quiz package.
 */

use Doctrine\Common\Collections\ArrayCollection;
use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Quiz
{
    const STATUS_DRAFT = 'draft';
    const STATUS_LIVE = 'live';
    const STATUS_ARCHIVED = 'archived';

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var \Phpugh\Quiz\Domain\Model\Category
     * @ORM\ManyToOne(inversedBy="quizzes")
     */
    protected $category;

    /**
     * @var ArrayCollection<\Phpugh\Quiz\Domain\Model\Question>
     * @ORM\OneToMany(mappedBy="quiz")
     */
    protected $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return ArrayCollection<\Phpugh\Quiz\Domain\Model\Question>
     */
    public function getQuestions() {
        return $this->questions;
    }

    /**
     * @param Question $question
     * @return void
     */
    public function addQuestion(Question $question) {
        $question->setQuiz($this);
        $this->questions->add($question);
    }
}
