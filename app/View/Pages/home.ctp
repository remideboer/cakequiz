<div class="center center-text margin-container">

    <h2>Welkom bij de Quiz</h2>
    <p>Je krijgt een aantal vragen waarbij je kunt kiezen uit een aantal antwoorden.<br> 
        Kies degene waarvan jij denkt dat het het goede antwoord is.
    </p>
    <p>Druk op start als je klaar bent om te beginnen.</p>
    <a href="<?php
    echo $this->Html->url([
        'controller' => 'questions',
        'action' => 'index',
        '?' => ['start' => true]
    ])
    ?>">
        <button class="question-button">START</button></a>

</div>
