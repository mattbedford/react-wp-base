function Tester(){

    const useState = wp.element.useState;
    const useEffect = wp.element.useEffect;

    const [mosts, setMosts] = useState(0);
    const [boasts, setBoasts] = useState(null);

    function mandleClick() {
        setBoasts(boasts + 1);
    }

      useEffect(() => {
            wp.apiFetch({ path: '/react-base/v1/get-posts' })
                .then((data) => {
                    setBoasts(data); // Store data in state
                })
                .catch((error) => {
                    console.error('Error fetching data:', error);
                });
        }, []);

    return (
        <div>

            <ul>
                {boasts && boasts.map((boast) => (
                    <li key={boast.ID}>{boast.ID}</li>
                ))}
            </ul>

        </div>
    );
}

export default Tester;