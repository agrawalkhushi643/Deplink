{{ flashSession.output() }}

{% if config.oauth2.github %}
    <a href="{{ url(['for': 'social-join', 'provider': 'github']) }}"> Sign up with GitHub </a>
{% endif %}
