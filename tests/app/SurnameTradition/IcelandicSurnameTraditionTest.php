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

namespace Fisharebest\Webtrees\SurnameTradition;

/**
 * Test harness for the class SpanishSurnameTradition
 */
class IcelandicSurnameTraditionTest extends \Fisharebest\Webtrees\TestCase
{
    /** @var SurnameTraditionInterface */
    private $surname_tradition;

    /**
     * Prepare the environment for these tests
     *
     * @return void
     */
    public function setUp()
    {
        $this->surname_tradition = new IcelandicSurnameTradition;
    }

    /**
     * Test whether married surnames are used
     *
     * @covers \Fisharebest\Webtrees\SurnameTradition\IcelandicSurnameTradition
     *
     * @return void
     */
    public function testMarriedSurnames()
    {
        $this->assertSame(false, $this->surname_tradition->hasMarriedNames());
    }

    /**
     * Test whether surnames are used
     *
     * @covers \Fisharebest\Webtrees\SurnameTradition\IcelandicSurnameTradition
     *
     * @return void
     */
    public function testSurnames()
    {
        $this->assertSame(false, $this->surname_tradition->hasSurnames());
    }

    /**
     * Test new son names
     *
     * @covers \Fisharebest\Webtrees\SurnameTradition\IcelandicSurnameTradition
     *
     * @return void
     */
    public function testNewSonNames()
    {
        $this->assertSame(
            ['NAME' => 'Jonsson'],
            $this->surname_tradition->newChildNames('Jon Einarsson', 'Eva Stefansdottir', 'M')
        );
    }

    /**
     * Test new daughter names
     *
     * @covers \Fisharebest\Webtrees\SurnameTradition\IcelandicSurnameTradition
     *
     * @return void
     */
    public function testNewDaughterNames()
    {
        $this->assertSame(
            ['NAME' => 'Jonsdottir'],
            $this->surname_tradition->newChildNames('Jon Einarsson', 'Eva Stefansdottir', 'F')
        );
    }

    /**
     * Test new child names
     *
     * @covers \Fisharebest\Webtrees\SurnameTradition\IcelandicSurnameTradition
     *
     * @return void
     */
    public function testNewChildNames()
    {
        $this->assertSame(
            [],
            $this->surname_tradition->newChildNames('Jon Einarsson', 'Eva Stefansdottir', 'U')
        );
    }

    /**
     * Test new father names
     *
     * @covers \Fisharebest\Webtrees\SurnameTradition\IcelandicSurnameTradition
     *
     * @return void
     */
    public function testNewFatherNames()
    {
        $this->assertSame(
            [
                'NAME' => 'Einar',
                'GIVN' => 'Einar',
            ],
            $this->surname_tradition->newParentNames('Jon Einarsson', 'M')
        );
    }

    /**
     * Test new mother names
     *
     * @covers \Fisharebest\Webtrees\SurnameTradition\IcelandicSurnameTradition
     *
     * @return void
     */
    public function testNewMotherNames()
    {
        $this->assertSame(
            [],
            $this->surname_tradition->newParentNames('Jon Einarsson', 'F')
        );
    }

    /**
     * Test new parent names
     *
     * @covers \Fisharebest\Webtrees\SurnameTradition\IcelandicSurnameTradition
     *
     * @return void
     */
    public function testNewParentNames()
    {
        $this->assertSame(
            [],
            $this->surname_tradition->newParentNames('Jon Einarsson', 'U')
        );
    }

    /**
     * Test new husband names
     *
     * @covers \Fisharebest\Webtrees\SurnameTradition\IcelandicSurnameTradition
     *
     * @return void
     */
    public function testNewHusbandNames()
    {
        $this->assertSame(
            [],
            $this->surname_tradition->newSpouseNames('Eva Stefansdottir', 'M')
        );
    }

    /**
     * Test new wife names
     *
     * @covers \Fisharebest\Webtrees\SurnameTradition\IcelandicSurnameTradition
     *
     * @return void
     */
    public function testNewWifeNames()
    {
        $this->assertSame(
            [],
            $this->surname_tradition->newSpouseNames('Jon Einarsson', 'F')
        );
    }

    /**
     * Test new spouse names
     *
     * @covers \Fisharebest\Webtrees\SurnameTradition\IcelandicSurnameTradition
     *
     * @return void
     */
    public function testNewSpouseNames()
    {
        $this->assertSame(
            [],
            $this->surname_tradition->newSpouseNames('Jon Einarsson', 'U')
        );
    }
}
