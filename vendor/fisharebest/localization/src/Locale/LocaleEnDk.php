<?php namespace Fisharebest\Localization\Locale;

use Fisharebest\Localization\Territory\TerritoryDk;

/**
 * Class LocaleEnDe - English
 *
 * @author    Greg Roach <fisharebest@gmail.com>
 * @copyright (c) 2018 Greg Roach
 * @license   GPLv3+
 */
class LocaleEnDk extends LocaleEn
{
    protected function percentFormat()
    {
        return self::PLACEHOLDER . self::NBSP . self::PERCENT;
    }

    public function territory()
    {
        return new TerritoryDk();
    }
}
