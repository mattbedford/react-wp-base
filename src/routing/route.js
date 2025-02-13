
const Route = ({ path, children }) => {

    const useState = wp.element.useState;
    const useEffect = wp.element.useEffect;

    // Utility function to ensure trailing slash
    const ensureTrailingSlash = (pathname) => {

        // Sanitize the pathname to ensure a clean className (thanks AI)
        document.body.className = pathname
            .replace(/[^a-zA-Z0-9-]/g, '-') // Replace non-alphanumeric characters with a hyphen
            .replace(/^-|-$/g, '') // Remove leading or trailing hyphens
            .toLowerCase(); // Make it lowercase for consistency

        return pathname.endsWith("/") ? pathname : `${pathname}/`;
    };

    // State to track URL and force component to re-render on change
    const [currentPath, setCurrentPath] = useState(() => {
        // Immediately ensure trailing slash on initial load
        const pathnameWithSlash = ensureTrailingSlash(window.location.pathname);
        if (window.location.pathname !== pathnameWithSlash) {
            window.history.replaceState({}, '', pathnameWithSlash);
        }
        return pathnameWithSlash;
    });

    useEffect(() => {
        // Define callback as separate function so it can be removed later with cleanup function
        const onLocationChange = () => {
            const pathnameWithSlash = ensureTrailingSlash(window.location.pathname);
            if (window.location.pathname !== pathnameWithSlash) {
                // Update URL in browser without adding a new history entry
                window.history.replaceState({}, '', pathnameWithSlash);
            }
            // Update path state to current window URL
            setCurrentPath(pathnameWithSlash);
        };

        // Listen for popstate event (triggered on back/forward navigation)
        window.addEventListener('popstate', onLocationChange);

        // Clean up event listener
        return () => {
            window.removeEventListener('popstate', onLocationChange);
        };
    }, []);

    return currentPath === path
        ? children
        : null;
}

export default Route;