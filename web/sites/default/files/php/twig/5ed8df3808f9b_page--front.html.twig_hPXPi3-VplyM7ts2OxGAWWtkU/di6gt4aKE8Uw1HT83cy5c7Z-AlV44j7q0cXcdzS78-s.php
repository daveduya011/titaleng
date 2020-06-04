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

/* themes/contrib/leng/templates/system/page--front.html.twig */
class __TwigTemplate_aa13f5634c6c6da039276ffc0e6ed69e302c3c16c0428c17f153a0ff6353c291 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'main' => [$this, 'block_main'],
            'header' => [$this, 'block_header'],
            'featured' => [$this, 'block_featured'],
            'highlighted' => [$this, 'block_highlighted'],
            'action_links' => [$this, 'block_action_links'],
            'help' => [$this, 'block_help'],
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 7, "block" => 16];
        $filters = ["escape" => 9, "without" => 60];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'block'],
                ['escape', 'without'],
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

    protected function doGetParent(array $context)
    {
        // line 1
        return "page.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("page.html.twig", "themes/contrib/leng/templates/system/page--front.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_main($context, array $blocks = [])
    {
        // line 5
        echo "  <div role=\"main\" class=\"main-container js-quickedit-main-content\">
      ";
        // line 7
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "navigation", [])) {
            // line 8
            echo "        <div id=\"off-canvas\" class=\"side-flyout collapse left\">
          ";
            // line 9
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "navigation", [])), "html", null, true));
            echo "
        </div>
      ";
        }
        // line 12
        echo "
      
      ";
        // line 15
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "header", [])) {
            // line 16
            echo "        ";
            $this->displayBlock('header', $context, $blocks);
            // line 19
            echo "      ";
        }
        // line 20
        echo "
      
      ";
        // line 23
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "featured", [])) {
            // line 24
            echo "        ";
            $this->displayBlock('featured', $context, $blocks);
            // line 27
            echo "      ";
        }
        // line 28
        echo "
      ";
        // line 30
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
            // line 31
            echo "        ";
            $this->displayBlock('highlighted', $context, $blocks);
            // line 36
            echo "      ";
        }
        // line 37
        echo "
      <div class=\"row\">
        ";
        // line 40
        echo "        <section";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content_attributes"] ?? null)), "html", null, true));
        echo ">

          ";
        // line 43
        echo "          ";
        if (($context["action_links"] ?? null)) {
            // line 44
            echo "            ";
            $this->displayBlock('action_links', $context, $blocks);
            // line 47
            echo "          ";
        }
        // line 48
        echo "
          ";
        // line 50
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "help", [])) {
            // line 51
            echo "            ";
            $this->displayBlock('help', $context, $blocks);
            // line 54
            echo "          ";
        }
        // line 55
        echo "
          ";
        // line 57
        echo "          ";
        $this->displayBlock('content', $context, $blocks);
        // line 63
        echo "        </section>
      </div>
    </div>
  </div>
";
    }

    // line 16
    public function block_header($context, array $blocks = [])
    {
        // line 17
        echo "            ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true));
        echo "
        ";
    }

    // line 24
    public function block_featured($context, array $blocks = [])
    {
        // line 25
        echo "            ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "featured", [])), "html", null, true));
        echo "
        ";
    }

    // line 31
    public function block_highlighted($context, array $blocks = [])
    {
        // line 32
        echo "          <div class=\"container\">
            <div class=\"highlighted\">";
        // line 33
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true));
        echo "</div>
          </div>
          ";
    }

    // line 44
    public function block_action_links($context, array $blocks = [])
    {
        // line 45
        echo "              <ul class=\"action-links\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["action_links"] ?? null)), "html", null, true));
        echo "</ul>
            ";
    }

    // line 51
    public function block_help($context, array $blocks = [])
    {
        // line 52
        echo "              ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "help", [])), "html", null, true));
        echo "
            ";
    }

    // line 57
    public function block_content($context, array $blocks = [])
    {
        // line 58
        echo "            <a id=\"main-content\"></a>
            <div class=\"container\">
            ";
        // line 60
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->withoutFilter($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "leng_page_title"), "html", null, true));
        echo "
            </div>
          ";
    }

    public function getTemplateName()
    {
        return "themes/contrib/leng/templates/system/page--front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  231 => 60,  227 => 58,  224 => 57,  217 => 52,  214 => 51,  207 => 45,  204 => 44,  197 => 33,  194 => 32,  191 => 31,  184 => 25,  181 => 24,  174 => 17,  171 => 16,  163 => 63,  160 => 57,  157 => 55,  154 => 54,  151 => 51,  148 => 50,  145 => 48,  142 => 47,  139 => 44,  136 => 43,  130 => 40,  126 => 37,  123 => 36,  120 => 31,  117 => 30,  114 => 28,  111 => 27,  108 => 24,  105 => 23,  101 => 20,  98 => 19,  95 => 16,  92 => 15,  88 => 12,  82 => 9,  79 => 8,  76 => 7,  73 => 5,  70 => 4,  60 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/leng/templates/system/page--front.html.twig", "/var/www/html/titaleng/web/themes/contrib/leng/templates/system/page--front.html.twig");
    }
}
