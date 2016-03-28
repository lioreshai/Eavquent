<?php

namespace spec\Devio\Eavquent\Attribute;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Cache\Repository;

class CacheSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Devio\Eavquent\Attribute\Cache');
    }

    function let(Repository $cache)
    {
        $this->beConstructedWith($cache);
    }

    function it_checks_for_cache_existance(Repository $cache)
    {
        $cache->has('eav')->shouldBeCalled()->willReturn(false);
        $this->exists()->shouldBe(false);

        $cache->has('eav')->shouldBeCalled()->willReturn(true);
        $this->exists()->shouldBe(true);
    }

    function it_gets_all_cached_attributes(Repository $cache)
    {
        $collection = new Collection(['foo', 'bar']);
        $cache->get('eav')->shouldBeCalled()->willReturn($collection);

        $this->get()->shouldBe($collection);
    }

    function it_stores_given_attributes(Repository $cache)
    {
        $collection = new Collection;

        $cache->forget('eav')->shouldBeCalled();
        $cache->forever('eav', $collection)->shouldBeCalled();

        $this->set($collection);
    }
}