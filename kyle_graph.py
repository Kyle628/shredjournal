class vertex:
    def __init__(self, value):
        self.value = value
        self.connected_verts = {}

class graph:
    def __init__(self):
        self.vertices = {}

    def add_vertex(self, value):
        new_vertex = vertex(value)
        self.vertices[value] = new_vertex
        return

    def add_edge(self, frm, to, weight=0):
        self.vertices[frm].connected_verts[to] = weight

    
