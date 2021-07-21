{% extends "base.html" %}

{% block title %}Index{% endblock %}
{% block head %}
    {{ parent() }}
{% endblock %}
{% block content %}

<div class="right_col" role="main"> <!-- page content -->
<iframe
    width="100%"
    height="700"
    src="assets/diagrama.pdf">
</iframe>
</div><!-- /page content -->
{% endblock %}
    
{% block script %}
    {{ parent() }}
    
{% endblock %}
