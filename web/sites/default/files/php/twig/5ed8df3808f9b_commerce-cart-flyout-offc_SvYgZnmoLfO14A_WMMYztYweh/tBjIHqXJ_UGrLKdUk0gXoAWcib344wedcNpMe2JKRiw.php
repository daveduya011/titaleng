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

/* themes/contrib/leng/templates/commerce/cart/commerce-cart-flyout-offcanvas.html.twig */
class __TwigTemplate_f9db6954b208ccbaa92c5d09dd5853b2ba939021bd0868774223e9cca4a9a43d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["t" => 3];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['t'],
                []
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
        // line 1
        echo "<div class=\"cart--cart-offcanvas well well-lg well-primary\">
  <div class=\"cart--cart-offcanvas__close\">
    <button type=\"button\" class=\"button btn close-btn\"><span class=\"visually-hidden\">";
        // line 3
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Close cart")));
        echo "</span></button>
  </div>
  <% if (count > 0) { %>
  <div class=\"cart-block--offcanvas-contents\">
    <div class=\"cart-block--offcanvas-contents__inner\">
      <h2>";
        // line 8
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Shopping bag")));
        echo "</h2>
      <div class=\"cart-block--offcanvas-contents__items\"></div>
      <div class=\"cart-block--offcanvas-contents__links\">
        <%= links %>
      </div>
      <div class=\"cart--cart-offcanvas__close visible-xs visible-sm text-align-center\">
        <button type=\"button\" class=\"button btn-link\">";
        // line 14
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Continue shopping")));
        echo "</button>
      </div>
    </div>
  </div>
  <% } else { %>
  <div>";
        // line 19
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Your cart is empty.")));
        echo "</div>
  <% } %>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/leng/templates/commerce/cart/commerce-cart-flyout-offcanvas.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 19,  76 => 14,  67 => 8,  59 => 3,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/leng/templates/commerce/cart/commerce-cart-flyout-offcanvas.html.twig", "/var/www/html/titaleng/web/themes/contrib/leng/templates/commerce/cart/commerce-cart-flyout-offcanvas.html.twig");
    }
}
