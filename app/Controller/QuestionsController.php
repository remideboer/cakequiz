<?php

App::uses('QuestionManager', 'Lib');
App::uses('ScoreKeeper', 'Lib');

class QuestionsController extends AppController {

    public $helper = ['Html', 'Session'];
    private $questionManager;

    public function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        $this->questionManager = new QuestionManager($this->Question);
    }

    /**
     * The Quiz is taken as a single resources
     * Index processes questions
     */
    public function index() {

        $this->destroySessionIfNeeded();

        if(isset($this->params['url']['a'])){
            $current = $this->questionManager->getCurrentQuestion();
            
            if ($current['Question']['correct_answer_id'] == $this->params['url']['a']) {
                ScoreKeeper::increaseScore();
            }
            
        }

        $this->next();
    }

    public function end() {

        $score = ScoreKeeper::currentScore();

        $this->set('questionTotal', $this->questionManager->getQuizLength());
        $this->set('score', $score);
    }

    /**
     * Check if a previous session needs to be destroyed so values are fresh
     * if  query string parameer 'start' isset then destroy
     */
    private function destroySessionIfNeeded() {
        if (isset($this->params['url']['start'])) {
            CakeSession::destroy();
        }
    }

    /**
     * Process to the next step, either next question or end screen
     */
    private function next(){
        
        $question = $this->questionManager->nextQuestion();

        if (!empty($question)) {
            
            $this->set('question', $question);
            $this->set('questionTotal', $this->questionManager->getQuizLength());
            $this->set('score', ScoreKeeper::currentScore());
            
        } else {
            
            $this->goToEndScreen();
            
        }
    }    
    
    private function goToEndScreen() {
        return $this->redirect([
                    'controller' => 'questions',
                    'action' => 'end'
                    ]
        );
    }


}
