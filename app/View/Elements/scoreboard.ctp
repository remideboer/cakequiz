<div id="scoreBoard" class="center margin-container ">
    <h3 class="inline highlight-text-color">SCORE: </h3> 
    <?php for ($i = 0; $i < $score; $i++) { ?>
        <div class="mark correct"></div>
    <?php } ?>
    <!-- load incorrect -->    
    <?php for ($i = 0; $i < ($questionTotal - $score); $i++) { ?>
        <div class="mark"></div>
    <?php } ?>
    <!--<h3 class="inline highlight-text-color"><?=$score . '/' . $questionTotal?></h3>-->     
</div>
