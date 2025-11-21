const fetchShowMoreGoods = async (curPage) => {
  try {
    const response = await fetch("/api/showMoreGoods.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ curPage })
    });
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    window.currentPage++;
    return data;
  } catch (error) {
    console.error("Fetch API error:", error);
    throw error;
  }
};
export {
  fetchShowMoreGoods as f
};
