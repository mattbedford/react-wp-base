function Posts(){

    const useState = wp.element.useState;
    const useEffect = wp.element.useEffect;

    const [apiHits, setApiHits] = useState(0);
    const [posts, setPosts] = useState([]);

    function fetchLatestPosts() {
        wp.apiFetch({ path: '/react-base/v1/get-posts' })
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

            <ul>
                {posts && posts.map((post) => (
                    <li key={post.ID}>{post.ID}</li>
                ))}
            </ul>

            <p>You have hit the API {apiHits} times!</p>
            <button onClick={fetchLatestPosts}>click me to update post list</button>

        </div>
    );
}

export default Posts;