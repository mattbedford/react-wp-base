const PostSingle = ({ post = {}, type }) => {
    const { title = {}, content = {}, image = {}, author = {} } = post;

    return (
        <div className="feed-post-single" data-post-type={type}>
            <h1>{title || 'Untitled Post'}</h1>
            <img
                src={image || 'https://gratisography.com/wp-content/uploads/2024/11/gratisography-augmented-reality-800x525.jpg'}
                alt={title || 'Fallback Image'}
            />
            <div className="feed-post-texts">
                <div dangerouslySetInnerHTML={{ __html: content || '' }} />
            </div>
        </div>
    );
};

export default PostSingle;