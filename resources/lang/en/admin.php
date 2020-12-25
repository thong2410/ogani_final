<?php
return [
    'quick_action' => 'Quick Action',
    'category' => [
        'category' => 'Category',
        'categories' => 'Categories',
        'create' => 'Create category',
        'delete' => 'Delete',
        'edit' => 'Edit',
        'name' => 'Name',
        'description' => 'Description',
        'not_found' => 'Category not found',
        'edit_success' => 'Edit Success',
        'del_success' => 'Delete Success',
        'search_placeholder' => 'Category name'
    ],
    'product' => [
        'product' => 'Product',
        'products' => 'Products',
        'create' => 'Add new product',
        'delete' => 'Delete product',
        'edit' => 'Edit product',
        'name' => 'Product Name',
        'unit_price' => 'Unit price',
        'sale' => 'Sale',
        'category' => 'Category',
        'detail' => 'Detail',
        'seo' => 'SEO',
        'picture' => 'Pricture',
        'content' => 'Content',
        'status' => 'Status',
        'normal' => 'Normal product',
        'feature' => 'Freature product',
        'seo_title' => 'Meta title',
        'description' => 'Meta description',
        'keywords' => 'Meta keywords',
        'create_success' => 'Added product success',
        'update_success' => 'Updated product success',
        'unit' => 'Unit',
        'quantity' => 'Quantity',
        'not_found' => 'Not found',
        'thumbnail' => 'Thumbnail',
        'add_more_detail_field' => 'Add',
        'remove_detail_field' => 'Remove selected',
        'search_placeholder' => 'Tên sản phẩm'
    ],
    'blog_category' =>[
        'blog' => 'Category',
        'category' => 'Article Category',
        'categories' => 'Article Categories',
        'parent' => 'Parent Category',
        'categories' => 'Categories',
        'create' => 'Create Category',
        'delete' => 'Delete',
        'edit' => 'Edit',
        'name' => 'Name',
        'description' => 'Description',
        'not_found' => 'Category not found',
        'edit_success' => 'Edit Success',
        'del_success' => 'Delete Success',
        'blog' => 'Category'
    ],
    'blog'=> [
        'category' => 'Catergory',
        'article' => 'Article',
        'articles' => 'Articles',
        'title' => 'Title',
        'content' => 'Content',
        'create' => 'Add new article',
        'delete' => 'Delete article',
        'edit' => 'Edit article',
        'thumb' => 'Image',
        'success_msg' => 'More posts succeeded',
        'not_found' => 'The article could not be found ',
        'edit_success' => 'Edit succeeded',
        'del_success' => 'Deletion succeeded',
        'validation' => [
            'required_title' => 'The title must not be blank',
            'required_content' => 'Content must not be left blank',
            'required_img' => 'Please choose to add a picture'
        ]
    ],
    'media' => [
        'open_media_library' => 'Open media library',
        'media_library' => 'Media library',
        'upload' => 'Upload',
        'library' => 'Library',
    ],
    'user'=>[
        'users' => 'Users',
        'avatar'=>'Avatar',
        'fullname'=>'Full Name',
        'username'=>'Username',
        'email'=>'Email Address',
        'phone'=>'Phone',
        'gender'=>[
            'male'=>'Male',
            'female'=>'Female',
            'gender'=>'Gender'
        ],
        'role'=> [
            'role' => 'Role',
            'member' => 'Member',
            'editor' => 'Editor',
            'admin' => 'Admin',
            'superadmin' => 'Super Admin'
        ],
        'not_found' => 'Not found this user',
        'can_not_remove_yourself' => 'Can not remove yoursel',
        'can_not_remove_supperadmin' => 'Can not remove super admin',
        'can_not_edit_supperadmin' => 'Can not edit super admin',
        'you_are_out_of_authority' => 'You are out of authority',
        'search_placeholder' => 'Name, Username, email...',
        'del_success' => 'Delete Success',
        'edit_success' => 'Edit Success',
        'profile'=> 'Account information',
        'edit'=> 'Edit account',
        'editComment'=> 'You can re-decentralize your account here.',
        'warning'=> 'You cannot lock admin account or your account',
        'password' => 'New password',
        'comfirm_password' => 'Comfirm password',
        'password_placehoder' => 'Enter if you want to change',
        'not_power'=>'You are not allowed to edit this account',
        'not_password_again'=>'Confirm the password is incorrect, please try again',
        'not_length_pass'=>'Password length must be more than 6 characters',
        'not_power_provided'=>'you are not authorized to grant this permission'
    ],
    'order' => [
        'orders' => 'Orders',
        'orders_user' => 'Order by :name',
        'username' => 'Username',
        'fullname' => 'Full name',
        'phone' => 'Phone',
        'email' => 'Email',
        'status' => 'Status',
        'not_found' => 'No orders found',
        'search_placeholder' => 'Order ID',
        'del_success' => 'Deleted successfully',
        'date' => 'Order date',
        'status_str' => [
            'processing' => 'Processing',
            'shipping' => 'Shipping',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled'
        ],
        'status_label' => [
            'processing' => '<span class="badge badge-primary">Processing</span>',
            'shipping' => '<span class="badge badge-info">Shipping</span>',
            'delivered' => '<span class="badge badge-success">Delivered</span>',
            'cancelled' => '<span class="badge badge-danger">Cancelled</span>'
        ],
        'order_id' => 'Order #:id',
        'order_items' => 'Order products',
        'order_notes' => 'Order notes',
        'customer_detail' => 'User information',
        'shipping_address' => 'Delivery address',
        'total' => 'Total',
        'shipping' => [
            'method' => 'Delivery method',
            'free_ship' => 'Free Delivery',
        ],
        'payment' => [
            'method' => 'Payment methods',
            'cod' => 'Payment on delivery',
        ],
        'customer' => [
            'fullname' => 'Full name',
            'email' => 'Email',
            'phone' => 'Phone',
        ],
        'close' => 'Close',
        'product' => 'Product',
        'quantity' => 'Quantity',
        'unit_price' => 'Unit Price',
        'total_price' => 'Total Price',
        'action' => 'Action',
        'update_success' => 'Successful order update',
        'can_not_update' => 'This order cannot be updated',
    ],
    'rating' => [
        'view_rating' => 'Product reviews',
        'content' => 'Content',
        'star' => 'Rating',
        'date' => 'Date',
        'search_placeholder' => 'Keywords..',
        'not_found' => 'Not found',
        'del_success' => 'Successful review removed'
    ],
    'contact' => [
        'contact'=>'contact',
        'fullname' => 'fullname',
        'email' => 'Email',
        'content' => 'content',    
        'send_success' => 'Contact successfully sent ',
        
        ],
    'comment' => [
        'view_comment' => 'See post comments',
        'content' => 'Content',
        'star' => 'Rating',
        'date' => 'Date',
        'search_placeholder' => 'Keywords..',
        'not_found' => 'Not found',
        'del_success' => 'Successful review removed'
    ],
    'home' => [
        'new_reviews' => 'Latest reviews',
        'product' => 'Product',
        'fullname' => 'Full name',
        'rating' => 'Rating',
        'time' => 'Time',
        'order' => 'Order',
        'orders_delivered' => 'Orders have been delivered',
        'products_in_stock' => 'Products in stock',
        'total_order_this_month' => 'Monthly order :month',
        'total_revenue_this_month' => 'Total sales this month',
        'chart_order' => 'Order statistics',
        'chart_order_by_month' => 'Statistics month',
        'new_orders' => 'New orders',
        'view_all' => 'View all',
        'order_item' => 'Order #:id',
        'status_str' => [
            'processing' => '<div class="st-timeline__point border-primary text-primary"> <i class="fad fa-rocket"></i> </div>',
            'shipping' => '<div class="st-timeline__point border-info text-info"> <i class="fad fa-box-open"></i> </div>',
            'delivered' => '<div class="st-timeline__point border-success text-success"> <i class="fad fa-check-double"></i> </div>',
            'cancelled' => '<div class="st-timeline__point st-timeline__point--solid bg-danger"> <i class="fad fa-window-close"></i> </div>'
        ],
    ]
];