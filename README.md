#Moz


This a is fork off [jongotlin/SeoMoz](https://github.com/jongotlin/SeoMoz).

A simple library to make requests against the free SeoMoz API.

##Use
  
```
composer install
  
$response = (new SeoMoz($accessId, $secretKey))->request('sunet.se');
print $response->getDomainAuthority();

```
### Run tests

```  
vendor/bin/phpspec run
```
