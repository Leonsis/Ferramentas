<?php
	/* 
 		Script para Ajudar na linkagem do site, ajuda a colocar sec e con nas class corretas.
   		Para identificar quais vão ser a seções e os conteudos de cada seção.
 	*/
	$index = __DIR__ . '/arquivo.html';
	$content = file_get_contents($index);
	
	if($content == false){
		echo "O arquivo.html não possui conteudo ou não foi encontrado.\n";
		die();
	}

	// Manipulando o arquivo
	libxml_use_internal_errors(true); // Ignorar erros de HTML malformado
	$dom = new DOMDocument();
	@$dom->loadHTML($content);
	$xpath = new DOMXpath($dom);

	$sectionsNoSec = $xpath->query('/html/body/section[not(@class="sec")]');    
	if($sectionsNoSec->length > 0) {
		foreach ($sectionsNoSec as $sectionNoSec) {
			if($sectionNoSec instanceof DOMElement) {
				$existingClass = $sectionNoSec->getAttribute('class');
				$newClass = trim($existingClass . ' sec');
				$sectionNoSec->setAttribute('class', $newClass);
			} else {
				echo "Elemento encontrado não é um DOMElement.\n";
			}
		}        
	} else {
		$divsNoSec = $xpath->query('/html/body/div[not(@class="sec")]');
        if($divsNoSec->length > 0) {
			foreach($divsNoSec as $divNoSec) {
				if($divNoSec instanceof DOMElement) {
					$existingClass = $divNoSec->getAttribute('class');
					$newClass = trim($existingClass . ' sec');
					$divNoSec->setAttribute('class', $newClass);
				} else {
					echo "Elemento encontrado não é um DOMElement.\n";
				}
			}
		}
	}
    
    /*
        Condição para adicionar a tag x somante quando a tag div tiver conteudo dentro dela.
        Caso a tag div não tenha nada a tag x não será colocada.
    */
    $divs = $xpath->query('.//div[not(.//p | .//a | .//h1 | .//h2 | .//h3 | .//h4 | .//h5 | .//h6 | .//img | .//strong | .//textarea | .//x | .//span | .//li) and  normalize-space(text())]');
    if($divs->length > 0) {
        foreach ($divs as $div) {
			if ($div instanceof DOMElement) {
				$text = $div->textContent;
				$div->nodeValue ='';
				// Criar o novo elemento x
				$newElement = $dom->createElement('x', htmlspecialchars($text));
				//$newElement->setAttribute('class', 'con');

				// Inserir o novo elemento no DOM
				$div->appendChild($newElement);
			} else {
				echo "Elemento encontrado não é um DOMElement.\n";
			}
        }
    }

  	// Encontrar as tags específicas dentro de cada <section>
	$lis = $xpath->query('.//li[not(.//p | .//a | .//h1 | .//h2 | .//h3 | .//h4 | .//h5 | .//h6 | .//img | .//strong | .//textarea | .//x | .//span)]');
	if ($lis->length > 0) {
		foreach ($lis as $li) {
			// Verifica se o texto não é vazio
			if (trim($li->textContent) !== '') {
				$hasSpecialTags = $xpath->query('.//i | .//img', $li)->length > 0;

				if ($hasSpecialTags) {
					// Caso tenha <i> ou <img>, encapsula o texto em um <x>
					foreach ($li->childNodes as $child) {
						if ($child instanceof DOMText && trim($child->wholeText) !== '') {
							$text = $child->wholeText;  // Pegar o texto original
							$child->nodeValue = '';     // Limpar o texto no nó atual

							// Criar o novo elemento <x> com o texto original
							$newElement = $dom->createElement('x', htmlspecialchars($text));
							$li->insertBefore($newElement, $child); // Adicionar <x> no lugar do texto
						}
					}
				} else {
					// Caso contrário, apenas adiciona a classe "con" ao <a>
					if ($li instanceof DOMElement) {
						$existingClass = $li->getAttribute('class');
						$newClass = trim($existingClass . ' con');
						$li->setAttribute('class', $newClass);
					}
				}
			}
		}
	}

	// Encontrar as tags específicas dentro de cada <section>
	$h2s = $xpath->query('.//h2[not(.//p | .//a | .//h1 | .//h3 | .//h4 | .//h5 | .//h6 | .//img | .//strong | .//textarea | .//x)]');
	if($h2s->length > 0) {
		foreach ($h2s as $h2) {
			if ($h2 instanceof DOMElement) {
				$hasIorImg = $xpath->query('.//i | .//img', $h2)->length > 0;
				$hasSpan = $xpath->query('.//span', $h2)->length > 0;

				if ($hasIorImg) {
					// Encapsula texto puro em <x> se houver <i> ou <img>
					foreach ($h2->childNodes as $child) {
						if ($child instanceof DOMText && trim($child->wholeText) !== '') {
							$text = $child->wholeText;
							$child->nodeValue = '';
							$newElement = $dom->createElement('x', htmlspecialchars($text));
							$h2->insertBefore($newElement, $child);
						}
					}
				} elseif ($hasSpan) {
					// Encapsula texto puro que é irmão direto de <span> em <x>
					foreach ($h2->childNodes as $child) {
						if ($child instanceof DOMText && trim($child->wholeText) !== '') {
							$text = $child->wholeText;
							$child->nodeValue = '';
							$newElement = $dom->createElement('x', htmlspecialchars($text));
							$h2->insertBefore($newElement, $child);
						}
					}
				} else {
					// Adiciona a classe 'con' normalmente
					$existingClass = $h2->getAttribute('class');
					$newClass = trim($existingClass . ' con');
					$h2->setAttribute('class', $newClass);
				}
			} else {
				echo "Elemento encontrado não é um DOMElement.\n";
			}
		}
	}

	// Encontrar as tags específicas dentro de cada <section>
	$h3s = $xpath->query('.//h3[not(.//p | .//a | .//h1 | .//h2 |  .//h4 | .//h5 | .//h6 | .//img | .//strong | .//textarea | .//x | .//span)]');
	if($h3s->length > 0) {
		foreach ($h3s as $h3) {
			// Verificar se o $tag é uma instância de DOMElement
			if ($h3 instanceof DOMElement) {
				// Obter o valor atual do atributo class
				$existingClass = $h3->getAttribute('class');
				// Adicionar a classe 'con', preservando as classes existentes
				$newClass = trim($existingClass . ' con');
				$h3->setAttribute('class', $newClass);
			} else {
				echo "Elemento encontrado não é um DOMElement.\n";
			}
		}
	}
	
    // Encontrar as tags específicas dentro de cada <section>
	$h5s = $xpath->query('.//h5[not(.//p | .//a | .//h1 | .//h2 | .//h4 | .//h6 | .//img | .//strong | .//textarea | .//x | .//span)]');
	if($h5s->length > 0) {
		foreach ($h5s as $h5) {
			// Verificar se o $tag é uma instância de DOMElement
			if ($h5 instanceof DOMElement) {
				// Obter o valor atual do atributo class
				$existingClass = $h5->getAttribute('class');
				// Adicionar a classe 'con', preservando as classes existentes
				$newClass = trim($existingClass . ' con');
				$h5->setAttribute('class', $newClass);
			} else {
				echo "Elemento encontrado não é um DOMElement.\n";
			}
		}
	} 

	// Encontrar as tags específicas dentro de cada <section>
	$h6s = $xpath->query('.//h6[not(.//p | .//a | .//h1 | .//h2 | .//h4 | .//h5 | .//img | .//strong | .//textarea | .//x | .//span)]');
	if($h6s->length > 0) {
		foreach ($h6s as $h6) {
			// Verificar se o $tag é uma instância de DOMElement
			if ($h6 instanceof DOMElement) {
				// Obter o valor atual do atributo class
				$existingClass = $h6->getAttribute('class');
				// Adicionar a classe 'con', preservando as classes existentes
				$newClass = trim($existingClass . ' con');
				$h6->setAttribute('class', $newClass);
			} else {
				echo "Elemento encontrado não é um DOMElement.\n";
			}
		}
	} 

	$buttons = $xpath->query('.//button[not(.//i | .//p | .//a | .//span | .//h1 | .//h2 | .//h3 | .//h4 | .//h5 | .//h6 | .//img | .//strong | .//textarea | .//x)]');
	if($buttons->length > 0) {
		foreach ($buttons as $button) {
			// Verificar se o $tag é uma instância de DOMElement
			if ($button instanceof DOMElement) {
				// Obter o valor atual do atributo class
				$existingClass = $button->getAttribute('class');
				// Adicionar a classe 'con', preservando as classes existentes
				$newClass = trim($existingClass . ' con');
				$button->setAttribute('class', $newClass);
			} else {
				echo "Elemento encontrado não é um DOMElement.\n";
			}
		}
	}

	$spans = $xpath->query('.//span[not(.//p) and not(.//a) and not(.//h1) and not(.//h2) and not(.//h3) and not(.//h4) and not(.//h5) and not(.//h6) and not(.//strong) and not(.//textarea) and not(.//x) and not(.//button) and not(.//span) and not(.//time) and normalize-space() != ""]');
	if ($spans->length > 0) {
		foreach ($spans as $span) {
			// Verifica se o texto não é vazio
			if (trim($span->textContent) !== '') {
				$hasSpecialTags = $xpath->query('.//i | .//img', $span)->length > 0;

				if ($hasSpecialTags) {
					// Caso tenha <i> ou <img>, encapsula o texto em um <x>
					foreach ($span->childNodes as $child) {
						if ($child instanceof DOMText && trim($child->wholeText) !== '') {
							$text = $child->wholeText;  // Pegar o texto original
							$child->nodeValue = '';     // Limpar o texto no nó atual

							// Criar o novo elemento <x> com o texto original
							$newElement = $dom->createElement('x', htmlspecialchars($text));
							$span->insertBefore($newElement, $child); // Adicionar <x> no lugar do texto
						}
					}
				} else {
					// Caso contrário, apenas adiciona a classe "con" ao <span>
					if ($span instanceof DOMElement) {
						$existingClass = $span->getAttribute('class');
						$newClass = trim($existingClass . ' con');
						$span->setAttribute('class', $newClass);
					}
				}
			}
		}
	}


	$as = $xpath->query('.//a[not(.//p) and not(.//h1) and not(.//h2) and not(.//h3) and not(.//h4) and not(.//h5) and not(.//h6) and not(.//strong) and not(.//textarea) and not(.//x) and not(.//button) and not(.//span) and not(.//time) and normalize-space() != ""]');
	if ($as->length > 0) {
		foreach ($as as $a) {
			// Verifica se o texto não é vazio
			if (trim($a->textContent) !== '') {
				$hasSpecialTags = $xpath->query('.//i | .//img', $a)->length > 0;

				if ($hasSpecialTags) {
					// Caso tenha <i> ou <img>, encapsula o texto em um <x>
					foreach ($a->childNodes as $child) {
						if ($child instanceof DOMText && trim($child->wholeText) !== '') {
							$text = $child->wholeText;  // Pegar o texto original
							$child->nodeValue = '';     // Limpar o texto no nó atual

							// Criar o novo elemento <x> com o texto original
							$newElement = $dom->createElement('x', htmlspecialchars($text));
							$a->insertBefore($newElement, $child); // Adicionar <x> no lugar do texto
						}
					}
				}
			}
		}
	}


	$tags = $xpath->query('.//p | .//h1 | .//h4 | .//img | .//strong | .//textarea | .//x | .//a');
	foreach ($tags as $tag) {
		// Verificar se o $tag é uma instância de DOMElement
		if ($tag instanceof DOMElement) {
			// Obter o valor atual do atributo class
			$existingClass = $tag->getAttribute('class');
			// Adicionar a classe 'con', preservando as classes existentes
			$newClass = trim($existingClass . ' con');
			$tag->setAttribute('class', $newClass);
		} else {
			echo "Elemento encontrado não é um DOMElement.\n";
		}
	}

	// Salvar as alterações no arquivo HTML
	$updatedHtml = $dom->saveHTML();
	if (file_put_contents($index, $updatedHtml) !== false) {
		echo 'Arquivo arquivo.html atualizado com sucesso.';
	} else {
		echo 'Erro ao salvar o arquivo arquivo.html.';
	}
?>
