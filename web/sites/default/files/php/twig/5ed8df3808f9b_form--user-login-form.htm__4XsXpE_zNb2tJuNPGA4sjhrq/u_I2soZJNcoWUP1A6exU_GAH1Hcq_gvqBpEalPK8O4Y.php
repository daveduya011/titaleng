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

/* themes/contrib/leng/templates/form/form--user-login-form.html.twig */
class __TwigTemplate_74f772c7cec612f0a07704ec3e3c30d5ed562b9397579e0eb84504247b4b4724 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'form_header' => [$this, 'block_form_header'],
            'form_footer' => [$this, 'block_form_footer'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["t" => 17];
        $functions = ["path" => 21];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['t'],
                ['path']
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

    protected function doGetParent(array $context)
    {
        // line 15
        return "form--user-form.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("form--user-form.html.twig", "themes/contrib/leng/templates/form/form--user-login-form.html.twig", 15);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 16
    public function block_form_header($context, array $blocks = [])
    {
        // line 17
        echo "  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Log in")));
        echo "
";
    }

    // line 19
    public function block_form_footer($context, array $blocks = [])
    {
        // line 20
        echo "  <h3>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Not a member yet?")));
        echo "</h3>
  <a class=\"btn btn-primary\" href=\"";
        // line 21
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("user.register")));
        echo "\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Sign up")));
        echo "</a>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/leng/templates/form/form--user-login-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 21,  78 => 20,  75 => 19,  68 => 17,  65 => 16,  55 => 15,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/leng/templates/form/form--user-login-form.html.twig", "/var/www/html/titaleng/web/themes/contrib/leng/templates/form/form--user-login-form.html.twig");
    }
}
