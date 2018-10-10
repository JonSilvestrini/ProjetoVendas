<?php

class Element {

	private $name;
	private $properties;
	private $children;

	public function __construct($name) {
		$this->name = $name;
	}

	public function __set($name, $value) {
		$this->properties[$name] = $value;
	}

	public function add($child) {
		$this->children[] = $child;
	}

	public function open() {
		echo "<$this->name";
		if ($this->properties) {
			// percorre as propriedades
			foreach ($this->properties as $name => $value) {
				echo " {$name}=\"{$value}\"";
			}
		}
		echo '>';
	}

	public function show() {
		$this->open();
		echo "\n";
		if ($this->children) {
			//percorre todos os objetos filhos
			foreach ($this->children as $child) {
				// se for objeto
				if (is_object($child)) {

					$child->show();
				} else if ((is_string($child)) or ( is_numeric($child))) {
					//se for texto
					echo $child;
				}
			}
			$this->close();
		}
	}

	private function close() {
		echo "</{$this->name}>\n";
	}

}
?>

