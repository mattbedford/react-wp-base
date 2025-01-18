import PostSingle from './post-single.js';

function Posts(){

    const useState = wp.element.useState;
    const useEffect = wp.element.useEffect;

    const [apiHits, setApiHits] = useState(0);
    const [posts, setPosts] = useState([]);

    function fetchLatestPosts(offset = 0) {
        wp.apiFetch({
            path: '/react-base/v1/get-posts',
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            data: { offset: offset}
        })
            .then((data) => {
                setPosts(data); // Store data in state
            })
            .catch((error) => {
                console.error('Error fetching data:', error);
            });
        setApiHits(apiHits + 1);

    }

    useEffect(() => {
        fetchLatestPosts()
    }, []);

    return (
        <div className="posts-feed">

                {posts && posts.map((post) => (
                    <PostSingle key={post.id} post={post} type={post.type}></PostSingle>
                ))}

            <p>You have hit the API {apiHits} times!</p>
            <button onClick={() => fetchLatestPosts(apiHits)}>click me to update post list</button>

        </div>
    );
}

export default Posts;