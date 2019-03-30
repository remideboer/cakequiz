<?php

/**
 * Manages the iteration over the Quiz questions
 * @author Rémi de Boer <remideboer@yahoo.com>
 */
class QuestionManager {

    const CURRENT_ID_SESSION_KEY = 'previousId';
    
    const QUIZ_LENGTH_SESSION_KEY = 'quizLength';
    
    /**
     * CakePHP Model that is used to query the Database
     * @var type Question
     */
    private $model;

    /**
     * Keeps an array of question id that needs to be iterated
     * @var type array
     */
    private $currentQuestion;

    /**
     * The id of the current question that is held in the session
     * to be used in the next query
     * @var type int
     */
    private $currentId;

    public function __construct(Question $model) {
        $this->model = $model;
    }

    /**
     * Returns the next question
     * If no next is present, an empty array will be returned
     * Could have a method hasNext to see if a next question exists
     * But that would hit the database twice in a row with the same query
     * @return array 
     */
    public function nextQuestion(): array {
        // see if session variable holding the current(previous) question id exists
        // so that can be used to get the next with a neighbours query
        // put that in a has next om the manager
        $this->currentId = CakeSession::read(self::CURRENT_ID_SESSION_KEY);
    
        if ($this->currentId === null) {
            
            $this->prepareFirstQuestion();
            
        } else {

            $this->setNextQuestion();
        }

        return $this->currentQuestion != null ? $this->currentQuestion : [];
    }

    /**
     * get the current question using a neighbour query 
     * using the previous question id
     */
    private function setNextQuestion() {
        $neighbors = $this->model->find(
                'neighbors', ['field' => 'id', 'value' => $this->currentId]
        );
        $this->currentQuestion = $neighbors['next'];
        $this->writeNextQuestionIdToSession();
    }

    /**
     * Gets the first question and and if its exists set the id in the session
     * 
     * @throws InternalErrorException if no question can be found
     */
    private function prepareFirstQuestion(){
        $this->currentQuestion = $this->model->find('first');
  
        if (!empty($this->currentQuestion)) {
            $this->writeNextQuestionIdToSession();
        } else {
            throw new InternalErrorException('No questions can be found');
        }
    }

    /**
     * Writes the id of the current question to the session to it can be used 
     * as the previous id in the next query
     */
    private function writeNextQuestionIdToSession(){
        CakeSession::write(self::CURRENT_ID_SESSION_KEY, $this->currentQuestion['Question']['id']);
    }
    
    /**
     * return the number of questions in this quiz
     */
    public function getQuizLength(): int {
        $length = CakeSession::read(self::QUIZ_LENGTH_SESSION_KEY);
        
        if($length === null) {
            $length = $this->model->find('count');
        }
        
        return $length;
    }
    
    public function getCurrentQuestion(): array {
        $id = CakeSession::read(self::CURRENT_ID_SESSION_KEY);
  
        return $this->model->findById($id);
    }
}
