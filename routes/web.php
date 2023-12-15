<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Models\Post;
use App\Models\User;
use App\Models\Review;
use App\Http\Controllers\AuthController;
use App\Models\Book;
use App\Models\Rating;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/




$router->group(['prefix'=>'api'],function() use ($router) 
{
    $router->post('/login','AuthController@login');
    $router->post('/register','AuthController@register');
    $router->post('/logout','AuthController@logout');
    $router->get('/check-token','AuthController@checkToken');

    $router->group(['middleware' => 'auth'], function () use ($router) 
    {
        $router->get('/posts','PostController@index');
        $router->post('/posts','PostController@store');
        $router->post('/posts/{id}','PostController@update');
        $router->post('/posts/delete/{id}','PostController@delete');
        $router->get('/comments-by-post/{id}','PostController@getCommentsByPost');
        /*** Comments ***/
        $router->post('/comments','CommentController@store');
        $router->post('/comments/delete/{id}','CommentController@delete');

        /*** Books ***/
        $router->get('/books','BookController@index');
        $router->post('/books','BookController@store');
        $router->post('/books/{id}','BookController@update');
        $router->post('/books/delete/{id}','BookController@delete');
        $router->get('/books/is-in-favourite-list/{book_id}','BookController@isInFavouriteList');
        $router->get('/books/search','BookController@search');

        /** Favourite  */
        $router->post('/add-to-favourite/{book_id}','FavouriteController@addBookToFavouriteList');
        $router->post('/remove-from-favourite/{book_id}','FavouriteController@removeBookFromFavouriteList');
        $router->get('/get-fav-books','FavouriteController@getFavBooks');

        /** Review */
        // $router->post('/add-review/{book_id}','ReviewController@addReview');
        // $router->post('/delete-review/{review_id}','ReviewController@deleteReview');
        $router->get('/get-book-reviews/{book_id}','ReviewController@getBookReviews');

        /** Rate */
        $router->post('/rate/{book_id}','RatingController@rate');
        $router->get('/get-book-rate/{book_id}','RatingController@getBookRate');
        $router->get('/get-book-rate-and-review/{book_id}','RatingController@getBookRateAndReview');
        $router->get('/top-rated-books','RatingController@getMaxRatedBook');
		
		/** Recommendation Controller **/

		$router->get('/get-similar-readers','RecommendationController@getSimilarReaders');
		$router->post('/recommend-book/{book_id}/{user_id}','RecommendationController@recommendBook');
		$router->post('/is-already-recommended/{book_id}/{user_id}','RecommendationController@isAlreadyRecommended');
		$router->get('/get-recommended-books','RecommendationController@getRecommendedBooks');

        /** User Controller - Profile */
        $router->get('/get-my-profile','UserController@getMyProfile');
        $router->get('/get-reader-profile/{user_id}','UserController@getReaderProfile');
        $router->post('/update-my-profile','UserController@updateMyProfile');
        $router->post('/update-my-password','UserController@updateMyPassword');
        $router->get('/get-all-other-users','UserController@getAllOtherUsers');
        /** Follow Controller */
        $router->get('/is-already-followed/{similar_reader_id}','FollowController@isAlreadyFollowed');
        $router->post('/follow/{similar_reader_id}','FollowController@follow');
        $router->post('/un-follow/{similar_reader_id}','FollowController@unFollow');
        $router->get('/get-followed-similar-readers','FollowController@getFollowedSimilarReaders');
        $router->get('/get-posts-by-followed-similar-readers','FollowController@getPostsByFollowedSimilarReaders');
    });
    // $router->get('/get-book-reviews/{book_id}','ReviewController@getBookReviews');
    // $router->get('/posts/{id}','PostController@index');
    // $router->get('/books','BookController@index');

    
}); 
// $router->get('/get-book-reviews/{book_id}','ReviewController@getBookReviews');
// $router->get('/top-rated-books','RatingController@getMaxRatedBook');

// $router->get('/get-similar-readers','RecommendationController@getSimilarReaders');
// $router->get('/get-recommended-books','RecommendationController@getRecommendedBooks');
// $router->get('/get-fav-books','FavouriteController@getFavBooks');




$router->get('/', function () use ($router) {
    // $book = Book::findOrFail(101);
    // $data = [];
    // $i=0;
    // foreach($book->ratings as $row)
    // {
    //     $data[$i]['user'] = User::findOrFail($row->user_id);
    //     $data[$i]['review'] = $row->review;
    //     $data[$i]['rating'] = $row->rating;
    //     $i++;
    // }
    // dd($data);
    // $res = User::select('password')->where('username','ibrahim')->first();
    // dd($res->password);
    // $test = password_verify('qqqqqq', '$2y$10$HUM5VpdDjoO/jilbsIrZX.5uZ52yAqFf2nhW8c01j7bjQyrgSy/GO');
    // dd($test);
    // $res = Review::where('user_id',7)->first();
    // if(!$res)
    // dd($res);
    // return $router->app->version();
    // $user = App\Models\User::find(10);
    // dd($user->recommended_books);
    // $arr = [];
    // foreach($book->ratings as $rating){
    //     $user = $rating->user;
    //     $b = $rating->book;
    //     $arr['user'] = $user;
    //     $arr['book'] = $b;
    //     $arr['rating'] = $rating->rating;

    // }
    // dd($arr);
    
    // dd();
    // $user = User::find(1);
    // $post = Post::find(1);
    // return $post->user;
});
