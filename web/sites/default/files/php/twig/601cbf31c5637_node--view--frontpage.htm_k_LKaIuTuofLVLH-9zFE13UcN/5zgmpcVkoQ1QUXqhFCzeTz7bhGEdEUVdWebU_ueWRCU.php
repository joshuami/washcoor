<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/contrib/bfd/templates/page/frontpage/node--view--frontpage.html.twig */
class __TwigTemplate_e0e9d002aa4777fe81a6c58569857fc9f2ee76b9d92b5a4802439659702e90f5 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 74
        $context["classes"] = [0 => "node", 1 => "flex-column", 2 => "d-flex", 3 => ("node--type-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,         // line 78
($context["node"] ?? null), "bundle", [], "any", false, false, true, 78), 78, $this->source))), 4 => ((twig_get_attribute($this->env, $this->source,         // line 79
($context["node"] ?? null), "isPromoted", [], "method", false, false, true, 79)) ? ("node--promoted") : ("")), 5 => ((twig_get_attribute($this->env, $this->source,         // line 80
($context["node"] ?? null), "isSticky", [], "method", false, false, true, 80)) ? ("node--sticky") : ("")), 6 => (( !twig_get_attribute($this->env, $this->source,         // line 81
($context["node"] ?? null), "isPublished", [], "method", false, false, true, 81)) ? ("node--unpublished") : ("")), 7 => ((        // line 82
($context["view_mode"] ?? null)) ? (("node--view-mode-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["view_mode"] ?? null), 82, $this->source)))) : (""))];
        // line 85
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("classy/node"), "html", null, true);
        echo "
<article";
        // line 86
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 86), 86, $this->source), "html", null, true);
        echo ">

";
        // line 88
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_image", [], "any", false, false, true, 88)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["#items"] ?? null) : null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 89
            echo "  ";
            $context["image"] = ["#theme" => "image_style", "#style_name" => "wide", "#uri" => twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 92
$context["item"], "entity", [], "any", false, false, true, 92), "uri", [], "any", false, false, true, 92), "value", [], "any", false, false, true, 92), "#alt" => twig_get_attribute($this->env, $this->source,             // line 93
$context["item"], "alt", [], "any", false, false, true, 93), "#width" => twig_get_attribute($this->env, $this->source,             // line 94
$context["item"], "width", [], "any", false, false, true, 94), "#height" => twig_get_attribute($this->env, $this->source,             // line 95
$context["item"], "height", [], "any", false, false, true, 95)];
            // line 97
            echo "  ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["image"] ?? null), 97, $this->source), "html", null, true);
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 99
        echo "  ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_tags", [], "any", false, false, true, 99), 99, $this->source), "html", null, true);
        echo "
  ";
        // line 100
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "field_forums", [], "any", false, false, true, 100), 100, $this->source), "html", null, true);
        echo "
  ";
        // line 101
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "taxonomy_forums", [], "any", false, false, true, 101), 101, $this->source), "html", null, true);
        echo "

    ";
        // line 103
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 103, $this->source), "html", null, true);
        echo "
  ";
        // line 104
        if ((($context["label"] ?? null) &&  !($context["page"] ?? null))) {
            // line 105
            echo "    <h2";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_attributes"] ?? null), 105, $this->source), "html", null, true);
            echo ">
      <a href=\"";
            // line 106
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 106, $this->source), "html", null, true);
            echo "\" rel=\"bookmark\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 106, $this->source), "html", null, true);
            echo "</a>
    </h2>
  ";
        }
        // line 109
        echo "  ";
        if (($context["display_submitted"] ?? null)) {
            // line 110
            echo "    <footer class=\"node__meta\">
      ";
            // line 111
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["author_picture"] ?? null), 111, $this->source), "html", null, true);
            echo "
      <div";
            // line 112
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["author_attributes"] ?? null), "addClass", [0 => "node__submitted"], "method", false, false, true, 112), 112, $this->source), "html", null, true);
            echo ">
        ";
            // line 113
            echo t("Submitted by @author_name on @date", array("@author_name" => ($context["author_name"] ?? null), "@date" => ($context["date"] ?? null), ));
            // line 114
            echo "        ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["metadata"] ?? null), 114, $this->source), "html", null, true);
            echo "
      </div>
    </footer>
  ";
        }
        // line 118
        echo "  ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 118, $this->source), "html", null, true);
        echo "
  ";
        // line 119
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "body", [], "any", false, false, true, 119), 119, $this->source), "html", null, true);
        echo "
  ";
        // line 120
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 120, $this->source), "field_tags", "body", "field_image", "taxonomy_forums"), "html", null, true);
        echo "
</article>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/bfd/templates/page/frontpage/node--view--frontpage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 120,  137 => 119,  132 => 118,  124 => 114,  122 => 113,  118 => 112,  114 => 111,  111 => 110,  108 => 109,  100 => 106,  95 => 105,  93 => 104,  89 => 103,  84 => 101,  80 => 100,  75 => 99,  66 => 97,  64 => 95,  63 => 94,  62 => 93,  61 => 92,  59 => 89,  55 => 88,  50 => 86,  46 => 85,  44 => 82,  43 => 81,  42 => 80,  41 => 79,  40 => 78,  39 => 74,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/bfd/templates/page/frontpage/node--view--frontpage.html.twig", "/var/www/html/web/themes/contrib/bfd/templates/page/frontpage/node--view--frontpage.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 74, "for" => 88, "if" => 104, "trans" => 113);
        static $filters = array("clean_class" => 78, "escape" => 85, "without" => 120);
        static $functions = array("attach_library" => 85);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for', 'if', 'trans'],
                ['clean_class', 'escape', 'without'],
                ['attach_library']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
