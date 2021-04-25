// I think there is some sort of repeations in urls !! but ok for now ...
export default{
    "baseURL": "http://localhost:8000/",
    "imageServerURL": "http://localhost:8000/image/",
    
    "getProductsURL": "api/products",
    "getProductURL": "api/products/",
    "deleteProductURL": "api/products/",
    "postProductURL": "api/products/",
    "putProductURL": "api/products/",
    "putProductAvailableURL": "api/products/available/",

    "getCategoriesURL": "api/categories",
    "getCategoryURL": "api/categories/",
    "deleteCategoryURL": "api/categories/",
    "postCategoryURL": "api/categories/",
    "putCategoryURL": "api/categories/",
    

}












// |
// |        | GET|HEAD  | api/categories            | categories.index   | App\Http\Controllers\a
//                         |
// |        | POST      | api/categories            | categories.store   | App\Http\Controllers\a
//                         |
// |        | GET|HEAD  | api/categories/{category} | categories.show    | App\Http\Controllers\a
//                         |
// |        | PUT|PATCH | api/categories/{category} | categories.update  | App\Http\Controllers\a
//                         |
// |        | DELETE    | api/categories/{category} | categories.destroy | App\Http\Controllers\a
//                         |
// |        | GET|HEAD  | api/products              | products.index     | App\Http\Controllers\a
//                         |
// |        | POST      | api/products              | products.store     | App\Http\Controllers\a
//                         |
// |        | GET|HEAD  | api/products/{product}    | products.show      | App\Http\Controllers\a
//                         |
// |        | PUT|PATCH | api/products/{product}    | products.update    | App\Http\Controllers\a
//                         |
// |        | DELETE    | api/products/{product}    | products.destroy   | App\Http\Controllers\a
// 
// |        | PUT       | api/products/available/{product}
//                         |
// |        | GET|HEAD  | api/testapi     