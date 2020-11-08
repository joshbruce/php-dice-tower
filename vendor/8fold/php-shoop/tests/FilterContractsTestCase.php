<?php

namespace Eightfold\Shoop\Tests;

use PHPUnit\Framework\TestCase;

use \ReflectionClass;
use \ReflectionMethod;

abstract class FilterContractsTestCase extends TestCase
{
    abstract static public function sutClassName(): string;

    /**
     * Ignore these methods because they are either value holders, use the basic
     * implementation from Shoop pipes, is covered by another set of test cases,
     * or some combination thereof.
     */
    static protected function ignoreClassMethods()
    {
        return [
            "main",
            "args", // value method, returns args following or incl. main
            "rewind", // part of PHP iterator interface
            "valid", // part of PHP iterator interface
            "current", // part of PHP iterator interface
            "key", // part of PHP iterator interface
            "next", // part of PHP iterator interface
            "jsonSerialize", // uses efToTuple
            "count", // uses efToInteger
            "fold",
            "unfold"
        ];
    }

    /**
     * @test
     */
    public function case_exists_for_each_method()
    {
        $caseReflection = new ReflectionClass(static::class);
        $caseMethods    = $caseReflection->getMethods(ReflectionMethod::IS_PUBLIC);
        $caseMethods    = array_map(
            function($reflectionMethod) {
                if (! in_array($reflectionMethod->name, ["setUp", "testsExistForEachMethod"]) and
                    $reflectionMethod->class === static::class
                ) {
                    if ($reflectionMethod->name === "_at") {
                        return "at";

                    } elseif ($reflectionMethod->name === "_isEmpty") {
                        return "isEmpty";

                    } elseif ($reflectionMethod->name === "_isJson") {
                        return "isJson";

                    }
                    return $reflectionMethod->name;
                }
            },
            $caseMethods,
        );
        $caseMethods = array_values(array_filter($caseMethods));

        $sutReflection = new ReflectionClass(static::sutClassName());
        $sutMethods    = $sutReflection->getMethods(ReflectionMethod::IS_PUBLIC);
        $sutMethods    = array_map(
            function($reflectionMethod) {
                if (! in_array($reflectionMethod->name, static::ignoreClassMethods()) and
                    $reflectionMethod->name[0] !== "_"
                ) {
                    return $reflectionMethod->name;
                }
            },
            $sutMethods,
        );
        $sutMethods = array_values(array_filter($sutMethods));
        // $sutMethods[] = "php_iterator";

        $notTested = array_diff($sutMethods, $caseMethods);
        sort($notTested);
        $notTestedString = print_r($notTested, true);
        $this->assertEquals(0, count($notTested), "The following methods have not been tested (only whether a test method exists): {$notTestedString}");
    }
}
