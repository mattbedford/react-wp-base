// Using "state" in React. (Which is a BIG deal).
// This is the most modern way to handle "state" inside an App. And handling state is key.
// You import useState. By default it has 2 parts:
// - An undefined VALUE - the value of our "state" when we first run the component
// - An undefined FUNCTION - this is what we use to update the state

//const useState = wp.element.useState;

function Fetcher() {

    const useState = wp.element.useState;

    // Note how we pass in "0", which gives our initial state.
    const [count, setCount] = useState(0);

    function handleClick() {
        setCount(count + 1);
    }

    return (
        <div>
            Clicked {count} times
        </div>
    );
}

export default Fetcher;