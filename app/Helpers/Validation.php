<?php

namespace App\Helpers;

use http\Exception\UnexpectedValueException;

class Validation
{

//    private $errors;
//    private $data;
//
//    public function make(array $data, array $rules)
//    {
//        $valid = true;
//
//        $this->data = $data;
//
//        foreach ($rules as $item => $value) {
//            $value = explode('|', $value);
//            foreach ($value as $rule) {
//                $pos = strpos($rule, ':');
//                if ($pos !== false) {
//                    $parameter = substr($rule, $pos + 1);
//                    $rule = substr($rule, 0, $pos);
//                } else {
//                    $parameter = '';
//                }
//                $MethodName = ucfirst($rule);
//
//                $valuee = isset($data[$item]) ? $data[$item] : null;
//
//                if (method_exists($this, $MethodName)) {
//                    if ($this->{$MethodName}($item, $valuee, $parameter) == false) {
//                        $valid = false;
//                        break;
//                    }
//                }
//            }
//        }
//
//        return $valid;
//    }
//
//    public function getErrors()
//    {
//        return $this->errors;
//    }
//
//    private function required($item, $value)
//    {
//        if (strlen($value) == 0) {
//            $this->errors[$item][] = "پرکردن فیلد {$item} الزامیست";
//            return false;
//        }
//        return true;
//    }
//
//    private function email($item, $value)
//    {
//        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
//            $this->errors[$item][] = "فرمت ایمیل وارد شده صحیح نیست";
//            return false;
//        }
//        return true;
//    }
//
//    private function min($item, $value, $param)
//    {
//        if (strlen($value) < $param) {
//            $this->errors[$item][] = "طول فیلد {$item} کمتر از {$param} کاراکتر است";
//        }
//    }
//
//    private function max($item, $value, $param)
//    {
//        if (strlen($value) > $param) {
//            $this->errors[$item][] = "طول فیلد {$item} بیشتر از {$param} کاراکتر است";
//        }
//    }
//
//    private function confirm($item, $value, $param)
//    {
//        $orginal = isset($this->data[$item]) ? $this->data[$item] : null;
//        $confirm = isset($this->data[$param]) ? $this->data[$param] : null;
//
//        if ($orginal !== $confirm) {
//            $this->errors[$item][] = "فیلد {$item} با فیلد {$param} برار نیست";
//            return false;
//        }
//        return true;
//    }
//
//}

    /**
     * @var
     */
    private $errors;

    /**
     * @var
     */
    private $data;

    /**
     * @param array $data
     * @param array $rules
     * @return bool
     */
    public function make(array $data, array $rules)
    {
        $valid = true;

        $this->data = $data;


        foreach ($rules as $item => $ruleset) {
            $ruleset = explode('|', $ruleset);

            foreach ($ruleset as $rule) {
                $pos = strpos($rule, ":");

                if ($pos !== false) {
                    $parametr = substr($rule, $pos + 1);
                    $rule = substr($rule, 0, $pos);
                } else {
                    $parametr = "";
                }

                $MethodName = ucfirst($rule);

                $value = isset($data[$item]) ? $data[$item] : null;

                if (method_exists($this, $MethodName)) {
                    if ($this->{$MethodName}($item, $value, $parametr) == false) {
                        $valid = false;
                        break;
                    }
                }

            }
        }
        return $valid;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $item
     * @param $value
     * @return bool
     */
    private function required($item, $value)
    {
        if (strlen($value) == 0) {
            $this->errors[$item][] = "پرکردن فیلد {$item} الزامیست";
            return false;
        }
        return true;
    }

    /**
     * @param $item
     * @param $value
     * @return bool
     */
    private function email($item, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$item][] = "فرمت ایمیل وارد شده صحیح نیست";
            return false;
        }
        return true;
    }


    /**
     * @param $item
     * @param $value
     * @param $param
     * @return bool
     */
    private function min($item, $value, $param)
    {
        if (strlen($value) < $param) {
            $this->errors[$item][] = "طول فیلد {$item} کمتر از {$param} کاراکتر است ";
            return false;
        }
        return true;
    }

    /**
     * @param $item
     * @param $value
     * @param $param
     * @return bool
     */
    private function max($item, $value, $param)
    {
        if (strlen($value) > $param) {
            $this->errors[$item][] = "طول فیلد {$item} نمیتواند بیشتر از {$param} کراکتر باشد";
            return false;
        }
        return true;
    }

    private function confirm($item, $value, $param)
    {
        $orginal = isset($this->data[$item]) ? $this->data[$item] : null;
        $confirm = isset($this->data[$param]) ? $this->data[$param] : null;

        if ($orginal !== $confirm) {
            $this->errors[$item][] = "فیلد {$item} با فیلد {$param} برابر نیست";
            return false;
        }

        return true;

    }
}