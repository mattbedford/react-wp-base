const PostSingle = ({ post = {}, type }) => {
    const { title = {}, content = {}, image = {} } = post;

    return (
        <div className="feed-post-single" datatype={type}>
            <h1>{title || 'Untitled Post'}</h1>
            <img
                src={image.source_url || 'https://gratisography.com/wp-content/uploads/2024/11/gratisography-augmented-reality-800x525.jpg'}
                alt={title || 'Fallback Image'}
            />
            <div className="feed-post-texts">
                <p>Our post content is:</p>
                <div dangerouslySetInnerHTML={{ __html: content || '' }} />
            </div>
        </div>
    );
};

export default PostSingle;