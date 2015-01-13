<?php

class sfValidatorStrictString extends \sfValidatorString
{
    const BACKSLASH_REGEX = '/(?:\A[\n\r\s\t]|[\n\r\s\t]\z)/';

    protected function doClean($value)
    {
        $clean = parent::doClean($value);

        if (preg_match(self::BACKSLASH_REGEX, $clean)) {
            throw new sfValidatorError($this, 'invalid', array('value' => $value));
        }

        return $clean;
    }
}
