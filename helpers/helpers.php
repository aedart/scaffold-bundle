<?php

if (! function_exists('get_license_list')) {

    /**
     * Returns a list of SPDX license identifiers
     *
     * @see http://spdx.org/licenses/
     *
     * @return array
     */
    function get_license_list(){
        // TODO: Download list automatically from https://spdx.org/licenses/
        // TODO: Can be done via DOMDocument, @see https://github.com/composer/spdx-licenses/blob/master/src/SpdxLicensesUpdater.php
        // TODO: Cache license list
        return [
            'Apache-2.0',
            'BSD-2-Clause',
            'BSD-3-Clause',
            'BSD-4-Clause',
            'GPL-2.0',
            'GPL-2.0+',
            'GPL-3.0',
            'GPL-3.0+',
            'LGPL-2.1',
            'LGPL-2.1+',
            'LGPL-3.0',
            'LGPL-3.0+',
            'MIT',
            'proprietary'
        ];
    }
}

if (! function_exists('get_composer_type_list')) {

    /**
     * Returns list of supported composer package types
     *
     * @return array
     */
    function get_composer_type_list(){
        return [
            'library',
            'project',
            'metapackage',
            'composer-plugin'
        ];
    }
}

if (! function_exists('git_user_name')) {

    /**
     * Returns the git global config user.name
     *
     * @return string
     */
    function git_user_name(){
        return exec('git config --global user.name');
    }
}

if (! function_exists('git_user_email')) {

    /**
     * Returns the git global config user.email
     *
     * @return string
     */
    function git_user_email(){
        return exec('git config --global user.email');
    }
}