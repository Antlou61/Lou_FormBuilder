<?php
/******************************************************************
* @projectname:  Lou_FormBuilder
* @description:  Classe para gerar formulários HTML
* @file: Lou_FormBuilder.php
* @author: Antonio Lourenco <geral@infoscript.eu>
* @license: MIT
* @version: 1.00  09 04 2025
* @last modified: 09 04 2025
* @access   public
******************************************************************/
/*
Vantagens de usar uma classe:
    Reutilização: 
        Você pode usar a classe FormBuilder em várias partes do seu projeto para criar formulários consistentes.
    Manutenção: 
        Se precisar mudar a forma como um tipo de campo é gerado (por exemplo, adicionar uma classe CSS padrão a todos os inputs), você só precisa modificar o método correspondente na classe.
    Organização: 
        Separa a lógica de geração de HTML da lógica principal da sua aplicação.
    Legibilidade: 
        O código que usa a classe (como no exemplo de uso) fica mais limpo e focado no quê está sendo criado, não no como.
    Facilidade para adicionar lógica: 
        Você pode facilmente adicionar validações, tratamento de dados antigos (old input), ou integração com frameworks dentro da classe.
*/

class FormBuilder {
    
    public function startForm(string $action, string $method = 'post', array $attributes = []): string {
        $htmlAttributes = $this->buildAttributes($attributes);
        // htmlspecialchars no conteúdo para segurança
        return sprintf('<form action="%s" method="%s"%s>', htmlspecialchars($action), htmlspecialchars($method), $htmlAttributes);
    }

    public function endForm(): string {
        return '</form>';
    }

    public function input(string $type, string $name, string $value = '', array $attributes = []): string {
        $defaultAttributes = [
            'type' => $type,
            'name' => $name,
            'value' => $value,
        ];

        $allAttributes = array_merge($defaultAttributes, $attributes);
        $htmlAttributes = $this->buildAttributes($allAttributes);
        return sprintf('<input%s>', $htmlAttributes);
    }

    public function label(string $for, string $text, array $attributes = []): string {
        $defaultAttributes = ['for' => $for];
        $allAttributes = array_merge($defaultAttributes, $attributes);
        $htmlAttributes = $this->buildAttributes($allAttributes);
        return sprintf('<label%s>%s</label>', $htmlAttributes, htmlspecialchars($text));
    }

    public function select(string $name, array $options, string $selectedValue = '', array $attributes = []): string {
        $defaultAttributes = [
            'name' => $name,
        ];

        $allAttributes = array_merge($defaultAttributes, $attributes);
        $htmlAttributes = $this->buildAttributes($allAttributes);

        $optionsHtml = '';
        foreach ($options as $value => $text) {
            // Use htmlspecialchars for both value and text for security
            $valueEscaped = htmlspecialchars($value);
            $textEscaped = htmlspecialchars($text);
            // Check if this option should be selected
            $selectedAttribute = ($valueEscaped === $selectedValue) ? ' selected' : '';
            $optionsHtml .= sprintf('<option value="%s"%s>%s</option>', $valueEscaped, $selectedAttribute, $textEscaped);
        }

        return sprintf('<select%s>%s</select>', $htmlAttributes, $optionsHtml);
    }


    public function textarea(string $name, string $content = '', array $attributes = []): string {
        $defaultAttributes = [
            'name' => $name,
            // 'rows' e 'cols' podem ser adicionados aqui como padrão ou nos $attributes
        ];

        $allAttributes = array_merge($defaultAttributes, $attributes);
        $htmlAttributes = $this->buildAttributes($allAttributes);
        // htmlspecialchars no conteúdo para segurança
        return sprintf('<textarea%s>%s</textarea>', $htmlAttributes, htmlspecialchars($content));
    }

    private function buildAttributes(array $attributes): string {
        $html = '';
        foreach ($attributes as $key => $val) {
            if (is_bool($val)) {
                if ($val) {
                    $html .= ' ' . htmlspecialchars($key);
                }
            }
            elseif ($val !== null && $val !== '') {
                 $html .= sprintf(' %s="%s"', htmlspecialchars($key), htmlspecialchars($val));
            }
        }
        return $html;
    }

    /**
 * Gera um input do tipo 'date'.
 * Pode adicionar atributos padrão como 'required' ou validações de formato se desejado.
 */
public function dateInput(string $name, string $value = '', array $attributes = []): string {
    // Poderia adicionar lógica aqui, como definir um formato padrão se $value for um objeto DateTime
    return $this->input('date', $name, $value, $attributes);
}

/**
 * Gera um input do tipo 'number'.
 * Pode adicionar atributos padrão como 'step' ou 'min'/'max'.
 */
public function numberInput(string $name, string $value = '', array $attributes = []): string {
    // Exemplo: Adicionar step="any" por padrão se não for especificado
    if (!isset($attributes['step'])) {
        $attributes['step'] = 'any'; // Permite números decimais por padrão
    }
    return $this->input('number', $name, $value, $attributes);
}

/**
 * Gera um input do tipo 'tel'.
 * Pode adicionar um atributo 'pattern' padrão ou sugestões.
 */
public function telInput(string $name, string $value = '', array $attributes = []): string {
    // Exemplo: Adicionar um placeholder comum se não houver
    if (!isset($attributes['placeholder'])) {
        $attributes['placeholder'] = 'Ex: 912345678';
    }
    return $this->input('tel', $name, $value, $attributes);
}

}
?>

