<?php
/**
 * webtrees: online genealogy
 * Copyright (C) 2018 webtrees development team
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
declare(strict_types=1);

namespace Fisharebest\Webtrees\Module\BatchUpdate;

use Fisharebest\Webtrees\GedcomRecord;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Individual;

/**
 * Class BatchUpdateMissingDeathPlugin Batch Update plugin: add missing 1 BIRT/DEAT Y
 */
class BatchUpdateMissingDeathPlugin extends BatchUpdateBasePlugin
{
    /**
     * User-friendly name for this plugin.
     *
     * @return string
     */
    public function getName(): string
    {
        return I18N::translate('Add missing death records');
    }

    /**
     * Description / help-text for this plugin.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return I18N::translate('You can speed up the privacy calculations by adding a death record to individuals whose death can be inferred from other dates, but who do not have a record of death, burial, cremation, etc.');
    }

    /**
     * Does this record need updating?
     *
     * @param GedcomRecord $record
     *
     * @return bool
     */
    public function doesRecordNeedUpdate(GedcomRecord $record): bool
    {
        return $record instanceof Individual && $record->getFirstFact('DEAT') === null && $record->isDead();
    }

    /**
     * Apply any updates to this record
     *
     * @param GedcomRecord $record
     *
     * @return string
     */
    public function updateRecord(GedcomRecord $record): string
    {
        $old_gedcom = $record->gedcom();
        $new_gedcom = $old_gedcom . "\n1 DEAT Y";

        return $new_gedcom;
    }
}
