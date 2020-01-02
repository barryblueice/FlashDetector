<?php

/*
 * iTXTech FlashDetector
 *
 * Copyright (C) 2018-2020 iTX Technologies
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace iTXTech\FlashDetector;

abstract class Arrayable{

	public function __construct(array $arr = null){
		if($arr != null){
			foreach($arr as $k => $v){
				$this->{$k} = $v;
			}
		}
	}

	public function toArray() : array{
		$reflectionClass = new \ReflectionClass($this);
		$properties = $reflectionClass->getProperties();
		$info = [];
		foreach($properties as $property){
			if(is_object($this->{$property->getName()})){
				/** @var Arrayable $prop */
				$prop = $this->{$property->getName()};
				$info[$property->getName()] = $prop->toArray();
			}else{
				$info[$property->getName()] = $this->{$property->getName()};
			}
		}
		return $info;
	}
}
