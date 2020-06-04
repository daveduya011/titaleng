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

/* themes/contrib/leng/templates/commerce/commerce-product--full.html.twig */
class __TwigTemplate_b5164386dc0c5fa64f2129b2d85ec1e5ba60ea5e4820bee57a291825b7fd4c4a extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 24, "if" => 54];
        $filters = ["escape" => 22, "clean_class" => 26, "without" => 43];
        $functions = ["attach_library" => 22];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape', 'clean_class', 'without'],
                ['attach_library']
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
        // line 22
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("leng/commerce.product-images"), "html", null, true));
        echo "
";
        // line 24
        $context["classes"] = [0 => "commerce-product", 1 => ("commerce-product--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute(        // line 26
($context["product_entity"] ?? null), "bundle", [])))), 2 => "commerce-product--full"];
        // line 30
        echo "<article";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true));
        echo ">
  <div class=\"row\">
    <div class=\"col-md-6\">";
        // line 33
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_images", [])), "html", null, true));
        // line 34
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_field_images", [])), "html", null, true));
        // line 35
        echo "</div>
    <div class=\"col-md-6\">
      <div class=\"commerce-product__contents\">
        ";
        // line 39
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_title", [])), "html", null, true));
        // line 40
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "field_rating", [])), "html", null, true));
        // line 41
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_price", [])), "html", null, true));
        // line 42
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["product"] ?? null), "variation_list_price", [])), "html", null, true));
        // line 43
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["product"] ?? null)), "field_images", "variation_attributes", "variation_price", "variation_list_price", "variation_field_images", "field_rating", "field_feedback", "variation_title"), "html", null, true));
        // line 46
        echo "</div>
    </div>
  </div>
  <div class=\"container feedbacks\">
    <h1>Product reviews</h1>
    <div class=\"grid\">";
        // line 52
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["product"] ?? null), "field_feedback", []), 0, [], "array"), "comments", [], "array")), "html", null, true));
        // line 53
        echo "</div>
    ";
        // line 54
        if ((($context["hasBought"] ?? null) || ($context["is_admin"] ?? null))) {
            // line 55
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["product"] ?? null), "field_feedback", []), 0, [], "array"), "comment_form", [], "array")), "html", null, true));
        } else {
            // line 57
            echo "      <div class=\"note\">
      ";
            // line 58
            if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["product"] ?? null), "field_feedback", []), 0, [], "array"), "comments", [], "array") == null)) {
                // line 59
                echo "      <h2><div>No reviews yet.</div></h2>
      ";
            }
            // line 61
            echo "      You can submit reviews after your item has been delivered.</div>
    ";
        }
        // line 63
        echo "  </div>
</article>";
    }

    public function getTemplateName()
    {
        return "themes/contrib/leng/templates/commerce/commerce-product--full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 63,  113 => 61,  109 => 59,  107 => 58,  104 => 57,  101 => 55,  99 => 54,  96 => 53,  94 => 52,  87 => 46,  85 => 43,  83 => 42,  81 => 41,  79 => 40,  77 => 39,  72 => 35,  70 => 34,  68 => 33,  62 => 30,  60 => 26,  59 => 24,  55 => 22,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/leng/templates/commerce/commerce-product--full.html.twig", "/var/www/html/titaleng/web/themes/contrib/leng/templates/commerce/commerce-product--full.html.twig");
    }
}
