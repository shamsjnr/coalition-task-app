// Credit: "https://www.codingnepalweb.com/drag-and-drop-sortable-list-html-javascript/"
// The core part of this script is from a guy on YouTube

window.addEventListener('load', function() {

    let nextEl;
    let oldRank;

    const sortableList = document.querySelector(".sortable-list");
    const items = sortableList?.querySelectorAll(".item");
    items?.forEach(item => {
        item.addEventListener("dragstart", () => {

            oldRank = Number(item.dataset.rank) + 1; // Set the current rank

            // Adding dragging class to item after a delay
            setTimeout(() => item.classList.add("dragging"), 0);
        });
        // Removing dragging class from item on dragend event
        item.addEventListener("dragend", async () => {
            item.classList.remove("dragging");

            const parent = item.parentNode;
            let newRank = Array.prototype.indexOf.call(parent.children, item); // Get the new rank from drag (-1 denotes the last rank)
            newRank = Number(newRank) + 1;

            if ( Number(newRank) !== oldRank ) {
                newRank = newRank || -1;
                const token = document.querySelector('meta[name="csrf-token"]').content
                await fetch (`${item.dataset.url}`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ rank: newRank })
                });
            }
        });
    });

    const initSortableList = (e) => {
        e.preventDefault();
        const draggingItem = document.querySelector(".dragging");
        // Getting all items except currently dragging and making array of them
        let siblings = [...sortableList.querySelectorAll(".item:not(.dragging)")];
        // Finding the sibling after which the dragging item should be placed
        let nextSibling = siblings.find(sibling => {
            return e.clientY <= sibling.offsetTop + sibling.offsetHeight / 2;
        });
        // Inserting the dragging item before the found sibling
        sortableList.insertBefore(draggingItem, nextSibling);
        nextEl = nextSibling;
    }
    sortableList?.addEventListener("dragover", initSortableList);
    sortableList?.addEventListener("dragenter", e => e.preventDefault());
});
