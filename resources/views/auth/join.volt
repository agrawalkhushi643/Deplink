{{ flashSession.output() }}

{% if config.github.enabled %}
    <a href="{{ url(['for': 'social-join', 'provider': 'github']) }}"> Sign up with GitHub </a>
{% endif %}
