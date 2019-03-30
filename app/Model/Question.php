<?php
class Question extends AppModel {
    // all answers
    public $hasAndBelongsToMany = array(
            'Answer' => [
                'className' => 'Answer',
                'joinTable' => 'answers_questions',
                'foreignKey'=> 'question_id',
                'assocationForeignKey' => 'answer_id',
                'unique' => true
            ]
    );
}