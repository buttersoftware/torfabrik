Twig preference

change submit button - generated with form builder

{% block submit_widget %}
    <div class="btn-group pull-left">
        <a class="btn btn-danger" href="{{ path('slider') }}"> zurück</a> --> adding another button
        {% spaceless %}
            {% set type = type|default('submit') %} --> adding another button
            {{ form_widget(form, { 'attr': { 'class': 'btn btn-success' } }) }} --> set class of the button
        {% endspaceless %}
    </div>
{% endblock submit_widget %}

-------------------------------------------------------
Twig THEME

https://github.com/symfony/symfony/blob/master/src/Symfony/Bridge/Twig/Resources/views/Form/form_div_layout.html.twig