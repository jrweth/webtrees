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

namespace Fisharebest\Webtrees\Census;

use Fisharebest\Webtrees\Date;
use Fisharebest\Webtrees\Individual;
use Mockery;

/**
 * Test harness for the class CensusColumnMonthIfBornWithinYear
 */
class CensusColumnMonthIfBornWithinYearTest extends \Fisharebest\Webtrees\TestCase
{
    /**
     * Delete mock objects
     *
     * @return void
     */
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @covers \Fisharebest\Webtrees\Census\CensusColumnMonthIfBornWithinYear
     * @covers \Fisharebest\Webtrees\Census\AbstractCensusColumn
     *
     * @return void
     */
    public function testBornWithinYear()
    {
        $individual = Mockery::mock(Individual::class);
        $individual->shouldReceive('getBirthDate')->andReturn(new Date('01 JAN 1860'));

        $census = Mockery::mock(CensusInterface::class);
        $census->shouldReceive('censusDate')->andReturn('01 JUN 1860');

        $column = new CensusColumnMonthIfBornWithinYear($census, '', '');

        $this->assertSame('Jan', $column->generate($individual, $individual));
    }

    /**
     * @covers \Fisharebest\Webtrees\Census\CensusColumnMonthIfBornWithinYear
     * @covers \Fisharebest\Webtrees\Census\AbstractCensusColumn
     *
     * @return void
     */
    public function testBornOverYearBeforeTheCensus()
    {
        $individual = Mockery::mock(Individual::class);
        $individual->shouldReceive('getBirthDate')->andReturn(new Date('01 JAN 1859'));

        $census = Mockery::mock(CensusInterface::class);
        $census->shouldReceive('censusDate')->andReturn('01 JUN 1860');

        $column = new CensusColumnMonthIfBornWithinYear($census, '', '');

        $this->assertSame('', $column->generate($individual, $individual));
    }

    /**
     * @covers \Fisharebest\Webtrees\Census\CensusColumnMonthIfBornWithinYear
     * @covers \Fisharebest\Webtrees\Census\AbstractCensusColumn
     *
     * @return void
     */
    public function testBornAfterTheCensus()
    {
        $individual = Mockery::mock(Individual::class);
        $individual->shouldReceive('getBirthDate')->andReturn(new Date('02 JUN 1860'));

        $census = Mockery::mock(CensusInterface::class);
        $census->shouldReceive('censusDate')->andReturn('01 JUN 1860');


        $column = new CensusColumnMonthIfBornWithinYear($census, '', '');

        $this->assertSame('', $column->generate($individual, $individual));
    }


    /**
     * @covers \Fisharebest\Webtrees\Census\CensusColumnMonthIfBornWithinYear
     * @covers \Fisharebest\Webtrees\Census\AbstractCensusColumn
     *
     * @return void
     */
    public function testNoBirth()
    {
        $individual = Mockery::mock(Individual::class);
        $individual->shouldReceive('getBirthDate')->andReturn(new Date(''));

        $census = Mockery::mock(CensusInterface::class);
        $census->shouldReceive('censusDate')->andReturn('01 JUN 1860');

        $column = new CensusColumnMonthIfBornWithinYear($census, '', '');

        $this->assertSame('', $column->generate($individual, $individual));
    }
}
