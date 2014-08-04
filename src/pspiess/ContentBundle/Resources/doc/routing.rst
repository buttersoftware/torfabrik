clean routing
in routing.yml 
_index:
    path:     /index
    defaults: { _controller: pspiessContentBundle:Index:index }

in template {{ path('_index') }}