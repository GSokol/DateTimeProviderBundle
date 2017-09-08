DateTimeProviderBundle
======================

Symfony bundle for [gsokol/date-time-provider](https://packagist.org/packages/gsokol/date-time-provider) lib.

# Install

Install via [composer](https://getcomposer.org):

```bash
composer require gsokol/date-time-provider-bundle
```

And in `app/AppKernel.php`:

```php
// app/AppKernel.php

// ...
class AppKernel Extends Kernel
{
    // ...
    public function registerBundles()
    {
        $bundles = [
            // ...
            new GSokol\DateTimeProviderBundle\DateTimePorviderBundle(),
            // ...
        ];
        // ...
```

# Usage

Greedy request `DateTime`:

```php
doSomeStaff();
$timeOfRequestProcessionStart = $container->get('date-time-provider.greedy')->getRequestTime();
```

Lazy request `DateTime`:

```php
someLognOperation();
$currentTime = $container->get('date-time-provider.lazy')->getRequestTime();
```

Intervaling:

```php
$tomorrow = $container->get('date-time-provider.lazy')->getNewRequestTime()
    ->add(new \DateInterval('P1d'));
```

# Benefits

Lat's think, you have a class method, that should return the next hour `DateTime`. Something like this:

```php

class NextHour
{
    public function get()
    {
        return (new \DateTime())
            ->add(new \DateInterval('PT1h'));
    }
}
```

And now we need to cover it with unit tests. Oops, ![:hankey:](https://assets-cdn.github.com/images/icons/emoji/unicode/1f4a9.png)!

But if you inject providers:

```php
// class

use GSokol\DateTimeProvider\DateTimeProviderInterface;

class NextHour
{
    /**
     * @var DateTimeProviderInterface
     */
    private $dtProvider;

    public function __construct(DateTimeProviderInterface $dtProvider)
    {
        $this->dtProvider = $dtProvider;
    }

    public function get()
    {
        return $this->dtProvider->getCurrentTime()
            ->add(new \DateInterval('PT1h'));
    }
}
```

```php
// test

use GSokol\DateTimeProvider\DateTimeProviderInterface;
use PHPUnit\Framework\TestCase;

class NextHourTest extends TestCase
{
    public function testGet()
    {
        $dtStub = (new \DateTime())->setTimestamp(0);
        $dtExp = (new \DateTime())->setTimestamp(3600);
        $dtProvider = $this->getMockBuilder(DateTimeProviderInterface)
            ->disableOriginalConstructor()
            ->setMethods(['getCurrentTime'])
            ->getMock();
        $dtProvider->expects($this->once())
            ->method('getCurrentTime')
            ->will($this->returnValue($dtStub));

        $target = new NextHour($dtProvider);

        $this->assertEquals($dtExp, $target->get());
    }
}
```

![:+1:](https://assets-cdn.github.com/images/icons/emoji/unicode/1f44d.png)
