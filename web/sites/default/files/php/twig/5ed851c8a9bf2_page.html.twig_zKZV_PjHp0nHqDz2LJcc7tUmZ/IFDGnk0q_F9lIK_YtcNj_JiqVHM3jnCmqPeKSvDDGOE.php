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

/* page.html.twig */
class __TwigTemplate_80d8f6afdf2fae11284d6ca9f149021760eb07fa5dbbba8017a54b411b754858 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'navbar' => [$this, 'block_navbar'],
            'main' => [$this, 'block_main'],
            'header' => [$this, 'block_header'],
            'highlighted' => [$this, 'block_highlighted'],
            'breadcrumb' => [$this, 'block_breadcrumb'],
            'sidebar_first' => [$this, 'block_sidebar_first'],
            'action_links' => [$this, 'block_action_links'],
            'help' => [$this, 'block_help'],
            'content' => [$this, 'block_content'],
            'similar' => [$this, 'block_similar'],
            'sidebar_second' => [$this, 'block_sidebar_second'],
            'footer' => [$this, 'block_footer'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 59, "if" => 62, "block" => 63];
        $filters = ["escape" => 212, "clean_class" => 68, "t" => 83];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block'],
                ['escape', 'clean_class', 't'],
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
        // line 59
        $context["container"] = (($this->getAttribute($this->getAttribute(($context["theme"] ?? null), "settings", []), "fluid_container", [])) ? ("container-fluid") : ("container"));
        // line 61
        echo "
";
        // line 62
        if (($this->getAttribute(($context["page"] ?? null), "navigation", []) || $this->getAttribute(($context["page"] ?? null), "top_navigation", []))) {
            // line 63
            echo "  ";
            $this->displayBlock('navbar', $context, $blocks);
        }
        // line 98
        echo "
";
        // line 100
        $this->displayBlock('main', $context, $blocks);
        // line 199
        echo "
";
        // line 200
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 201
            echo "  ";
            $this->displayBlock('footer', $context, $blocks);
        }
        // line 207
        echo "

";
        // line 210
        if ($this->getAttribute(($context["page"] ?? null), "mobile_navigation", [])) {
            // line 211
            echo "  <div class=\"container-fluid container-mobile-navigation\">
  ";
            // line 212
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "mobile_navigation", [])), "html", null, true));
            echo "
  </div>
";
        }
    }

    // line 63
    public function block_navbar($context, array $blocks = [])
    {
        // line 64
        echo "    ";
        // line 65
        $context["navbar_classes"] = [0 => "navbar", 1 => (($this->getAttribute($this->getAttribute(        // line 67
($context["theme"] ?? null), "settings", []), "navbar_inverse", [])) ? ("navbar-inverse") : ("navbar-default")), 2 => (($this->getAttribute($this->getAttribute(        // line 68
($context["theme"] ?? null), "settings", []), "navbar_position", [])) ? (("navbar-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["theme"] ?? null), "settings", []), "navbar_position", []))))) : (($context["container"] ?? null)))];
        // line 71
        echo "    <header";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["navbar_attributes"] ?? null), "addClass", [0 => ($context["navbar_classes"] ?? null)], "method")), "html", null, true));
        echo " id=\"navbar\" role=\"banner\">
      ";
        // line 72
        if ( !$this->getAttribute(($context["navbar_attributes"] ?? null), "hasClass", [0 => ($context["container"] ?? null)], "method")) {
            // line 73
            echo "        <div class=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null)), "html", null, true));
            echo "\">
      ";
        }
        // line 75
        echo "      <div class=\"navbar-header\">
        ";
        // line 77
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "navigation", [])) {
            // line 78
            echo "          <button type=\"button\" class=\"toggle-btn\"  data-toggle=\"collapse\" data-target=\"#off-canvas\">
              <div class=\"toggle-btn--bars\">
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
              </div>
              <span class=\"toggle-btn--name hidden-xs\">";
            // line 83
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Menu")));
            echo "</span>
          </button>
        ";
        }
        // line 86
        echo "      </div>

      ";
        // line 89
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "top_navigation", [])) {
            // line 90
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "top_navigation", [])), "html", null, true));
            echo "
      ";
        }
        // line 92
        echo "      ";
        if ( !$this->getAttribute(($context["navbar_attributes"] ?? null), "hasClass", [0 => ($context["container"] ?? null)], "method")) {
            // line 93
            echo "        </div>
      ";
        }
        // line 95
        echo "    </header>
  ";
    }

    // line 100
    public function block_main($context, array $blocks = [])
    {
        // line 101
        echo "  <div role=\"main\" class=\"main-container js-quickedit-main-content\">
      ";
        // line 103
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "navigation", [])) {
            // line 104
            echo "        <div id=\"off-canvas\" class=\"side-flyout collapse left\">
          ";
            // line 105
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "navigation", [])), "html", null, true));
            echo "
        </div>
      ";
        }
        // line 108
        echo "
      ";
        // line 110
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "header", [])) {
            // line 111
            echo "        ";
            $this->displayBlock('header', $context, $blocks);
            // line 114
            echo "      ";
        }
        // line 115
        echo "


    <div class=\"container\">
      ";
        // line 120
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
            // line 121
            echo "        ";
            $this->displayBlock('highlighted', $context, $blocks);
            // line 124
            echo "      ";
        }
        // line 125
        echo "
      ";
        // line 127
        echo "      ";
        if (($context["breadcrumb"] ?? null)) {
            // line 128
            echo "        ";
            $this->displayBlock('breadcrumb', $context, $blocks);
            // line 131
            echo "      ";
        }
        // line 132
        echo "
      <div class=\"row\">

        ";
        // line 136
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])) {
            // line 137
            echo "          ";
            $this->displayBlock('sidebar_first', $context, $blocks);
            // line 142
            echo "        ";
        }
        // line 143
        echo "
        ";
        // line 145
        echo "        ";
        // line 146
        $context["content_classes"] = [0 => ((($this->getAttribute(        // line 147
($context["page"] ?? null), "sidebar_first", []) && $this->getAttribute(($context["page"] ?? null), "sidebar_second", []))) ? ("col-md-6") : ("")), 1 => ((($this->getAttribute(        // line 148
($context["page"] ?? null), "sidebar_first", []) && twig_test_empty($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])))) ? ("col-md-9") : ("")), 2 => ((($this->getAttribute(        // line 149
($context["page"] ?? null), "sidebar_second", []) && twig_test_empty($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])))) ? ("col-md-9") : (""))];
        // line 152
        echo "
        <section";
        // line 153
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content_attributes"] ?? null), "addClass", [0 => ($context["content_classes"] ?? null)], "method")), "html", null, true));
        echo ">

          ";
        // line 156
        echo "          ";
        if (($context["action_links"] ?? null)) {
            // line 157
            echo "            ";
            $this->displayBlock('action_links', $context, $blocks);
            // line 160
            echo "          ";
        }
        // line 161
        echo "
          ";
        // line 163
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "help", [])) {
            // line 164
            echo "            ";
            $this->displayBlock('help', $context, $blocks);
            // line 167
            echo "          ";
        }
        // line 168
        echo "
          ";
        // line 170
        echo "          ";
        $this->displayBlock('content', $context, $blocks);
        // line 176
        echo "
          ";
        // line 178
        echo "          ";
        if ($this->getAttribute(($context["page"] ?? null), "similar", [])) {
            // line 179
            echo "            ";
            $this->displayBlock('similar', $context, $blocks);
            // line 184
            echo "          ";
        }
        // line 185
        echo "        </section>

        ";
        // line 188
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])) {
            // line 189
            echo "          ";
            $this->displayBlock('sidebar_second', $context, $blocks);
            // line 194
            echo "        ";
        }
        // line 195
        echo "      </div>
    </div>
  </div>
";
    }

    // line 111
    public function block_header($context, array $blocks = [])
    {
        // line 112
        echo "            ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true));
        echo "
        ";
    }

    // line 121
    public function block_highlighted($context, array $blocks = [])
    {
        // line 122
        echo "          <div class=\"highlighted\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true));
        echo "</div>
          ";
    }

    // line 128
    public function block_breadcrumb($context, array $blocks = [])
    {
        // line 129
        echo "          ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["breadcrumb"] ?? null)), "html", null, true));
        echo "
        ";
    }

    // line 137
    public function block_sidebar_first($context, array $blocks = [])
    {
        // line 138
        echo "            <aside class=\"col-md-3\" role=\"complementary\">
              ";
        // line 139
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])), "html", null, true));
        echo "
            </aside>
          ";
    }

    // line 157
    public function block_action_links($context, array $blocks = [])
    {
        // line 158
        echo "              <ul class=\"action-links\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["action_links"] ?? null)), "html", null, true));
        echo "</ul>
            ";
    }

    // line 164
    public function block_help($context, array $blocks = [])
    {
        // line 165
        echo "              ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "help", [])), "html", null, true));
        echo "
            ";
    }

    // line 170
    public function block_content($context, array $blocks = [])
    {
        // line 171
        echo "            <a id=\"main-content\"></a>
            <div class=\"container-fluid\">
              ";
        // line 173
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true));
        echo "
            </div>
          ";
    }

    // line 179
    public function block_similar($context, array $blocks = [])
    {
        // line 180
        echo "              <div class=\"container-fluid\">
                ";
        // line 181
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "similar", [])), "html", null, true));
        echo "
              </div>
            ";
    }

    // line 189
    public function block_sidebar_second($context, array $blocks = [])
    {
        // line 190
        echo "            <aside class=\"col-sm-3\" role=\"complementary\">
              ";
        // line 191
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])), "html", null, true));
        echo "
            </aside>
          ";
    }

    // line 201
    public function block_footer($context, array $blocks = [])
    {
        // line 202
        echo "    <footer class=\"footer\" role=\"contentinfo\">
      ";
        // line 203
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\flag\TwigExtension\FlagCount')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true));
        echo "
    </footer>
  ";
    }

    public function getTemplateName()
    {
        return "page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  432 => 203,  429 => 202,  426 => 201,  419 => 191,  416 => 190,  413 => 189,  406 => 181,  403 => 180,  400 => 179,  393 => 173,  389 => 171,  386 => 170,  379 => 165,  376 => 164,  369 => 158,  366 => 157,  359 => 139,  356 => 138,  353 => 137,  346 => 129,  343 => 128,  336 => 122,  333 => 121,  326 => 112,  323 => 111,  316 => 195,  313 => 194,  310 => 189,  307 => 188,  303 => 185,  300 => 184,  297 => 179,  294 => 178,  291 => 176,  288 => 170,  285 => 168,  282 => 167,  279 => 164,  276 => 163,  273 => 161,  270 => 160,  267 => 157,  264 => 156,  259 => 153,  256 => 152,  254 => 149,  253 => 148,  252 => 147,  251 => 146,  249 => 145,  246 => 143,  243 => 142,  240 => 137,  237 => 136,  232 => 132,  229 => 131,  226 => 128,  223 => 127,  220 => 125,  217 => 124,  214 => 121,  211 => 120,  205 => 115,  202 => 114,  199 => 111,  196 => 110,  193 => 108,  187 => 105,  184 => 104,  181 => 103,  178 => 101,  175 => 100,  170 => 95,  166 => 93,  163 => 92,  157 => 90,  154 => 89,  150 => 86,  144 => 83,  137 => 78,  134 => 77,  131 => 75,  125 => 73,  123 => 72,  118 => 71,  116 => 68,  115 => 67,  114 => 65,  112 => 64,  109 => 63,  101 => 212,  98 => 211,  96 => 210,  92 => 207,  88 => 201,  86 => 200,  83 => 199,  81 => 100,  78 => 98,  74 => 63,  72 => 62,  69 => 61,  67 => 59,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "page.html.twig", "themes/contrib/leng/templates/system/page.html.twig");
    }
}
