<?php

use PhpCsFixer\Config;

$config = new Config();

$finder = PhpCsFixer\Finder::create()
    ->notPath('bootstrap/cache')
    ->notPath('storage')
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return $config
    ->setRules([
        '@PSR12' => true,
        'no_unused_imports' => true,
        'phpdoc_add_missing_param_annotation' => [
            'only_untyped' => true,
        ],
        'self_accessor' => true,
        'self_static_accessor' => true,
        'no_unneeded_curly_braces' => true,
        'no_superfluous_elseif' => true,
        'no_useless_else' => true,
        'simplified_if_return' => true,
        'yoda_style' => true,
        'function_typehint_space' => true,
        'lambda_not_used_import' => true,
        'fully_qualified_strict_types' => true,
        'global_namespace_import' => true,
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => [
                'class',
                'function',
                'const',
            ],
        ],
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'declare_parentheses' => true,
        'explicit_indirect_variable' => true,
        'single_space_after_construct' => true,
        'no_leading_namespace_whitespace' => true,
        'concat_space' => true,
        'object_operator_without_whitespace' => true,
        'operator_linebreak' => true,
        'standardize_increment' => true,
        'standardize_not_equals' => true,
        'align_multiline_comment' => [
            'comment_type' => 'all_multiline',
        ],
        'general_phpdoc_tag_rename' => [
            'replacements' => [
                'inheritDocs' => 'inheritDoc',
            ],
        ],
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_phpdoc' => true,
        'phpdoc_align' => true,
        'phpdoc_annotation_without_dot' => true,
        'phpdoc_single_line_var_spacing' => true,
        'no_useless_return' => true,
        'return_assignment' => true,
        'simplified_null_return' => true,
        'explicit_string_variable' => true,
        'single_quote' => true,
        'array_indentation' => true,
        'blank_line_before_statement' => true,
        'method_chaining_indentation' => true,
        'no_extra_blank_lines' => true,
        'no_spaces_around_offset' => true,
        'types_spaces' => true,
        'array_syntax' => ['syntax' => 'short'],
        'cast_spaces' => ['space' => 'none'],
        'list_syntax' => ['syntax' => 'short'],
        'lowercase_static_reference' => true,
        'no_empty_statement' => true,
        'not_operator_with_successor_space' => true,
        'phpdoc_order' => true,
        'phpdoc_scalar' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_trim' => true,
        'single_blank_line_at_eof' => true,
        'single_blank_line_before_namespace' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline' => true,

    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__ . '/.php_cs.cache');
