{{ flashSession.output() }}

{% if config.security.oauth2.providers.github is defined %}
    <a href="{{ url(['for': 'social-join', 'provider': 'github']) }}"> Sign up with GitHub </a>
{% endif %}
