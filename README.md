# PolyComments
Simple hookable commenting system leveraging polymorphic relationships. 
<strong>Early pre-alfa. May change drastically at any time.</strong>

##Installation

###Step 1: Backend
####Install via composer:
<pre>composer require ptrml/polycomments "dev-master"</pre>
####Register the service provider in <strong>conf/app.php</strong>:
<pre>
'providers' => [
...
Ptrml\Polycomments\PolyCommentsServiceProvider::class,
...
],
</pre>
####Publish stuff:
<pre>php artisan vendor:publish --tag=polycomments</pre>
####Implement both the interface and trait on your models:
<pre>
class Post extends Model implements CommentableInterface
{
    use Commentable;
    ...
}
</pre>
(Switch the Post model with your own)
<br>

###Step 2: Frontend
####Append <strong>PolyCommentsController.php</strong> with your calls (Post is an example model):
<pre>
class PolyCommentsController extends Controller
{
    function commentPost(Request $request,$id)
    {
        Commenter::comment(Post::find($id),$request);
        return redirect("home");
    }
    ...
}
</pre>
(Switch the Post model with your own)
####Append routes:
<pre>
Route::post('/polycomments/post/{id}', 'PolyCommentsController@commentPost')->name('polycomments.post');
</pre>
####Add the premade comments block to the views of your model:
<pre>
@include('polycomments::polycomments',['polycomments_subject'=>$post,'polycomments_route'=>'polycomments.post'])
</pre>
(polycomments_subject is your models instance, polycomments_route is the named route)
<br>

###Step 3: Customization
####Edit <strong>views/vendor/polycomments/*</strong> for a custom look and feel:

<br>
###Enjoy

<br><br><br><br>
## License

[MIT license](http://opensource.org/licenses/MIT).
