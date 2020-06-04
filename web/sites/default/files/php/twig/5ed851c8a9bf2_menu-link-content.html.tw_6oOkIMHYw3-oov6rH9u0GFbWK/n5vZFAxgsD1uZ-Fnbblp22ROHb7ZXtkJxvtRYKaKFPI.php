<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/contrib/menu_item_extras/templates/menu-link-content.html.twig */
class __TwigTemplate_8792e828a8ee2450482f34eb658c433f3d47b04602dffed131d39dc6a89411d9 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["import" => 15, "macro" => 19, "set" => 21, "if" => 28];
        $filters = ["escape" => 27];
        $functions = ["link" => 29];

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'set', 'if'],
                ['escape'],
                ['link']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

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

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 15
        $context["menu"] = $this;
        // line 16
        echo "
";
        // line 17
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menu"]->getmenu_link_content(($context["attributes"] ?? null), ($context["menu_link_content"] ?? null), ($context["show_item_link"] ?? null), ($context["content"] ?? null), ($context["elements"] ?? null))));
        echo "

";
    }

    // line 19
    public function getmenu_link_content($__attributes__ = null, $__menu_link_content__ = null, $__show_item_link__ = null, $__content__ = null, $__elements__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "attributes" => $__attributes__,
            "menu_link_content" => $__menu_link_content__,
            "show_item_link" => $__show_item_link__,
            "content" => $__content__,
            "elements" => $__elements__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 20
            echo "  ";
            $context["menu_link_content"] = $this;
            // line 21
            echo "  ";
            $context["menu_dropdown_classes"] = [0 => "menu-dropdown", 1 => (($this->getAttribute(            // line 23
($context["elements"] ?? null), "#menu_level", [], "array", true, true)) ? (("menu-dropdown-" . $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["elements"] ?? null), "#menu_level", [], "array")))) : ("")), 2 => (($this->getAttribute(            // line 24
($context["elements"] ?? null), "#view_mode", [], "array")) ? (("menu-type-" . $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["elements"] ?? null), "#view_mode", [], "array")))) : (""))];
            // line 26
            echo "
  <div";
            // line 27
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["menu_dropdown_classes"] ?? null)], "method")), "html", null, true));
            echo ">
    ";
            // line 28
            if (($context["show_item_link"] ?? null)) {
                // line 29
                echo "      ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getLink($context["menu_link_content"]->getgetTitle(), $context["menu_link_content"]->getgetUrlObject()), "html", null, true));
                echo "
    ";
            }
            // line 31
            echo "    ";
            if (($context["content"] ?? null)) {
                // line 32
                echo "      ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "html", null, true));
                echo "
    ";
            }
            // line 34
            echo "  </div>
";
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "modules/contrib/menu_item_extras/templates/menu-link-content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  115 => 34,  109 => 32,  106 => 31,  100 => 29,  98 => 28,  94 => 27,  91 => 26,  89 => 24,  88 => 23,  86 => 21,  83 => 20,  67 => 19,  60 => 17,  57 => 16,  55 => 15,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/menu_item_extras/templates/menu-link-content.html.twig", "/var/www/html/titaleng/web/modules/contrib/menu_item_extras/templates/menu-link-content.html.twig");
    }
}
