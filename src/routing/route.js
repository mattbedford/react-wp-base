
const Route = ({ path, children }) => {

    const useState = wp.element.useState;
    const useEffect = wp.element.useEffect;

    // state to track URL and force component to re-render on change
    const [currentPath, setCurrentPath] = useState(window.location.pathname);

    useEffect(() => {
        // define callback as separate function so it can be removed later with cleanup function
        const onLocationChange = () => {
            // update path state to current window URL
            setCurrentPath(window.location.pathname);
        }

        console.log("Route effect with path:" + path + " and currentPath: " + currentPath + " and children: " + children)

        // listen for popstate event
        window.addEventListener('popstate', onLocationChange);

        // clean up event listener
        return () => {
            window.removeEventListener('popstate', onLocationChange)
        };
    }, [])

    if(children) {
        console.log("Route has children: " + children);
    } else {
        console.log("Route has no children");
    }

    return currentPath === path
        ? children
        : null;
}

export default Route;