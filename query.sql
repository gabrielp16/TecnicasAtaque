SELECT users.*, user_detail.*
FROM users
    INNER JOIN user_detail ON users.id=user_detail.user_id;