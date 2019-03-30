
<div id="quizDiv center">

    <?php echo $this->element('scoreboard'); ?>

    <p id="questionText"></p>

    <div id="questionZone" class="center container-question-text">
        <p class="question-text"><?= $question['Question']['text']; ?></p>
    </div>

    <div id="answerZone" class="center margin-container">

        <?php
        shuffle($question['Answer']);
        foreach ($question['Answer'] as $answer):
            ?>
            <a href="<?php
            echo

            $this->Html->url([
                'controller' => 'questions',
                'action' => 'index',
                '?' => [
                    'a' => $answer['id']
                ]
            ])
            ?>">
                <button class="question-button"><?= $answer['text'] ?></button></a>
        <?php endforeach; ?>
    </div>
</div>