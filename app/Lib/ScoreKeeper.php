<?php

/**
 * Keeps track of the Score using the session
 *
 * @author Rémi de Boer <remideboer@yahoo.com>
 */
class ScoreKeeper {
    
    const SCORE_SESSION_KEY = 'score';
    
    const START_SCORE = 0;
    
    public static function increaseScore() {
        $score = ScoreKeeper::currentScore();
        CakeSession::write(self::SCORE_SESSION_KEY, ($score + 1));
    }
    
    public static function currentScore(): int {
        $score = CakeSession::read(self::SCORE_SESSION_KEY);
        if ($score === null) {
            $score = self::START_SCORE;
            CakeSession::write(self::SCORE_SESSION_KEY, $score);
        }
        return $score;
    }

}
