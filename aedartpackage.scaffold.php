<?php

/* ------------------------------------------------------------
 | Require blank package scaffold configuration
 * ------------------------------------------------------------ */

$scaffold = require __DIR__ . '/blankpackage.scaffold.php';

/* ------------------------------------------------------------
 | Name
 * ------------------------------------------------------------ */

$scaffold['name'] = 'Aedart Package';

/* ------------------------------------------------------------
 | Description
 * ------------------------------------------------------------ */

$scaffold['description'] = 'Aedart specific package';

/* ------------------------------------------------------------
 | Files
 * ------------------------------------------------------------ */

$scaffold['files'] = [
    'files/.gitignore'      => '.gitignore'
];

/* ------------------------------------------------------------
 | Template Data - Package Name
 * ------------------------------------------------------------ */

$scaffold['templateData']['packageName'] = [
    'type'          => \Aedart\Scaffold\Contracts\Templates\Data\Type::QUESTION,

    'question'      => 'Name of the package ("aedart/" prefixed)?',

    'value'         => '',

    'postProcess'   => function($answer, array $previousAnswers){
        // Prefix vendor
        $answer = 'aedart/' . $answer;

        // Trim and replace eventual whitespaces and underscores
        $answer = trim($answer);
        $answer = str_replace([' ', '_'], '-', $answer);

        // Remove eventual quotes - don't see why people would try!?
        $answer = str_replace('"', '', $answer);
        $answer = str_replace("'", '', $answer);

        return strtolower($answer);
    }
];

/* ------------------------------------------------------------
 | Template Data - Homepage
 * ------------------------------------------------------------ */

$scaffold['templateData']['homepage'] = [
    'type'          => \Aedart\Scaffold\Contracts\Templates\Data\Type::QUESTION,

    'question'      => 'Project Github URL ("https://github.com/aedart/" prefixed)?',

    'value'         => 'null',

    'postProcess'   => function($answer, array $previousAnswers){
        // Prefix
        $answer = 'https://github.com/aedart/' . $answer;

        if(!filter_var($answer, FILTER_VALIDATE_URL) === false){
            return $answer;
        }

        throw new \InvalidArgumentException(sprintf('URL "%s" is invalid', $answer));
    }
];

/* ------------------------------------------------------------
 | Templates
 * ------------------------------------------------------------ */

$scaffold['templates'] = [
    'aedartComposer' => [
        'source'        => 'snippets/aedart-composer.json.twig',

        'destination'   => [

            'postProcess'   => function($answer, array $previousAnswers){
                return 'composer.json';
            }
        ],
    ],
];

/* ------------------------------------------------------------
 | Scripts
 * ------------------------------------------------------------ */

$scaffold['scripts'] = [
    function(array $config){

        // NOTE: Composer actually yields output to STDERR... But why, just why !?!
        // @see https://github.com/composer/composer/issues/3795
        // This causes the script logging to log errors instead of just output.
        $script = 'cd ' . $config['outputPath'] . ' && composer install --no-interaction --prefer-dist --no-suggest';

        return new \Aedart\Scaffold\Scripts\CliScript([
            'timeout'   => 60,
            'script'    => $script
        ]);
    }
];

/* ------------------------------------------------------------
 | Finally, return the modified scaffold configuration
 * ------------------------------------------------------------ */
return $scaffold;