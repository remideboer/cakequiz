<div id="quizDiv">
    
    <?php echo $this->element('scoreboard'); ?>

    <h3 id="questionHeader" class="center margin-container highlight-text-color">
        Je hebt het einde van de quiz gehaald met <b><?=$score?></b>
        <?php echo $score == 1 ? 'goed antwoord' : 'goede antwoorden';?> van de <b><?=$questionTotal?></b> vragen.</h3>

    <p id="questionText" class="center"></p>

    <div id="questionZone" class="center container-question-text">
        
    </div>

</div>
</div>

